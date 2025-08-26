<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request;

use Exception;
use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Modifier\AbstractRequestModifier;
use JLanky\ZenPayments\Modifier\ContentTypeJsonRequestModifier;
use JLanky\ZenPayments\Modifier\RequestModifierInterface;
use JLanky\ZenPayments\Request\Modifier\CredentialsTokenProvider;
use JLanky\ZenPayments\Request\Modifier\DefaultModifiersFactory;
use JLanky\ZenPayments\Request\Modifier\HashHelperRequestIdProvider;
use JsonException;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

abstract class AbstractRequestFactory
{
    const PATH = '';
    const METHOD = 'POST';

    private ?DefaultModifiersFactory $defaultModifiersFactory = null;

    public function __construct(
        private readonly AbstractEnvironment          $environment,
        private readonly PsrDependenciesInterface     $psrDependencies,
        private readonly PrimaryDependenciesInterface $primaryDependencies,
        ?DefaultModifiersFactory $defaultModifiersFactory = null
    ) {
        $this->defaultModifiersFactory = $defaultModifiersFactory;
    }

    /** @return AbstractRequestModifier[] */
    abstract protected function getModifiers(): array;

    /**
     * Get default request modifiers using the factory.
     *
     * @return RequestModifierInterface[]
     */
    protected function getDefaultModifiers(): array
    {
        return $this->getDefaultModifiersFactory()
            ->create();
    }

    /**
     * Get the default modifiers factory instance (lazy loading).
     */
    private function getDefaultModifiersFactory(): DefaultModifiersFactory
    {
        if ($this->defaultModifiersFactory === null) {
            $this->defaultModifiersFactory = new DefaultModifiersFactory(
                new HashHelperRequestIdProvider($this->primaryDependencies->getHashHelper()),
                new CredentialsTokenProvider($this->environment),
                new ContentTypeJsonRequestModifier()
            );
        }

        return $this->defaultModifiersFactory;
    }

    protected function getPath(RequestDataInterface $requestData): string
    {
        return static::PATH;
    }

    protected function getMethod(): string
    {
        return static::METHOD;
    }

    /**
     * Create a request with common logic.
     *
     * @param RequestDataInterface $requestData
     * @return RequestInterface
     * @throws JsonException
     */
    public function createRequest(RequestDataInterface $requestData): RequestInterface
    {
        $this->validateRequestData($requestData);

        $url    = $this->environment->getBaseUrl() . $this->getPath($requestData);
        $method = $this->getMethod();

        $request = $this->psrDependencies
            ->getRequestFactory()
            ->createRequest($method, $url);

        $modifiers = $this->getModifiers();

        foreach ($modifiers as $modifier) {
            $request = $modifier->applyRequestModifier($request);
        }

        $serializer = $this->primaryDependencies->getSerializer();

        $bodyStream = $this->psrDependencies
            ->getStreamFactory()
            ->createStream(json_encode($serializer->serialize($requestData, 'json'), JSON_THROW_ON_ERROR));

        return $request->withBody($bodyStream);
    }

    private function validateRequestData(RequestDataInterface $requestData): void
    {
        $violations = $this->primaryDependencies
            ->getValidator()
            ->validate($requestData);

        if (count($violations) > 0) {
            throw new ValidationFailedException($requestData, $violations);
        }
    }
}
