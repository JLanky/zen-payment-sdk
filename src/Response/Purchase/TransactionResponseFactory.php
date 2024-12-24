<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Response\Purchase;

use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Response\AbstractResponseFactory;
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
