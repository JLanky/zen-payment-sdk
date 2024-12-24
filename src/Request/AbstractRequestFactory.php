<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request;

use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Modifier\AbstractRequestModifier;
use JsonException;
use Psr\Http\Message\RequestInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

abstract class AbstractRequestFactory
{
    public const PATH   = '';
    public const METHOD = 'POST';

    public function __construct(
        private readonly PsrDependenciesInterface     $psrDependencies,
        private readonly PrimaryDependenciesInterface $primaryDependencies,
        private readonly AbstractEnvironment          $environment,
    ) {
    }

    /** @return AbstractRequestModifier[] */
    abstract protected function getModifiers(): array;

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
