<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Response;

use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use Psr\Http\Message\ResponseInterface;

class TransactionResponseFactory extends AbstractResponseFactory
{
    public function __construct(private readonly PrimaryDependenciesInterface $primaryDependencies)
    {
    }

    public function createResponse(ResponseInterface $response): TransactionResponseData
    {
        $bodyArray = $this->handleResponse($response);

        return $this->primaryDependencies
            ->getSerializer()
            ->denormalize($bodyArray, TransactionResponseData::class);
    }
}
