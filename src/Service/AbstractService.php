<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Service;

use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractService
{
    public function __construct(private readonly PsrDependenciesInterface $psrDependencies)
    {
    }

    /** @throws ClientExceptionInterface */
    protected function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->psrDependencies
            ->getClient()
            ->sendRequest($request);
    }
}
