<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Response\CreateTransaction;

use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Response\AbstractResponseFactory;
use JLanky\ZenPayments\Response\ResponseDataInterface;
use Psr\Http\Message\ResponseInterface;

class CreateTransactionResponseFactory extends AbstractResponseFactory
{
    public function __construct(private readonly PrimaryDependenciesInterface $primaryDependencies)
    {
    }

    public function createResponse(ResponseInterface $response): CreateTransactionResponseData
    {
        $bodyArray = $this->handleResponse($response);

        return $this->primaryDependencies
            ->getSerializer()
            ->denormalize($bodyArray, CreateTransactionResponseData::class);
    }
}
