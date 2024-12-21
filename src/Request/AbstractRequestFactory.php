<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request;

use JLanky\ZenPayments\Config\Environment\BaseEnvironment;
use JLanky\ZenPayments\Modifier\AbstractRequestModifier;
use JsonException;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

abstract class AbstractRequestFactory
{
    public const PATH   = '';
    public const METHOD = 'POST';

    public function __construct(
        private readonly RequestFactoryInterface $psrRequestFactory,
        private readonly StreamFactoryInterface  $psrStreamFactory,
        private readonly BaseEnvironment $environment
    ) {
    }

    /** @return AbstractRequestModifier[] */
    abstract protected function getModifiers(): array;

    /**
     * Create a request with common logic.
     *
     * @param RequestDataInterface|null $requestData
     * @return RequestInterface
     * @throws JsonException
     */
    protected function createRequest(?RequestDataInterface $requestData = null): RequestInterface
    {
        $url    = $this->environment->getBaseUrl() . $this->getPath($requestData);
        $method = $this->getMethod();

        $request = $this->psrRequestFactory->createRequest($method, $url);

        $modifiers = $this->getModifiers();

        foreach ($modifiers as $modifier) {
            $request = $modifier->applyRequestModifier($request);
        }

        if ($requestData instanceof RequestDataInterface) {
            $bodyStream = $this->psrStreamFactory->createStream(json_encode($requestData->toArray(), JSON_THROW_ON_ERROR));
            $request    = $request->withBody($bodyStream);
        }

        return $request;
    }

    protected function getPath(RequestDataInterface $requestData): string
    {
        return static::PATH;
    }

    protected function getMethod(): string
    {
        return static::METHOD;
    }
}
