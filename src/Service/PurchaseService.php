<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Service;

use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Request\Purchase\CreateTransaction\CreateTransactionRequestData;
use JLanky\ZenPayments\Request\Purchase\CreateTransaction\CreateTransactionRequestFactory;
use JLanky\ZenPayments\Request\Purchase\GetTransaction\GetTransactionRequestData;
use JLanky\ZenPayments\Request\Purchase\GetTransaction\GetTransactionRequestFactory;
use JLanky\ZenPayments\Response\TransactionResponseData;
use JLanky\ZenPayments\Response\TransactionResponseFactory;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class PurchaseService extends AbstractService
{
    public function __construct(
        private readonly AbstractEnvironment          $environment,
        private readonly PsrDependenciesInterface     $psrDependencies,
        private readonly PrimaryDependenciesInterface $primaryDependencies,
    ) {
        parent::__construct($psrDependencies);
    }

    /**
     * @throws JsonException
     * @throws ClientExceptionInterface
     */
    public function createTransaction(CreateTransactionRequestData $createTransactionRequestData): TransactionResponseData
    {
        $createTransactionRequestFactory = new CreateTransactionRequestFactory(
            $this->environment,
            $this->psrDependencies,
            $this->primaryDependencies,
        );

        $request  = $createTransactionRequestFactory->createRequest($createTransactionRequestData);
        $response = $this->sendRequest($request);

        $transactionResponseFactory = new TransactionResponseFactory($this->primaryDependencies);

        return $transactionResponseFactory->createResponse($response);
    }

    /**
     * @throws JsonException
     * @throws ClientExceptionInterface
     */
    public function getTransaction(GetTransactionRequestData $getTransactionRequestData): TransactionResponseData
    {
        $getTransactionRequestFactory = new GetTransactionRequestFactory(
            $this->environment,
            $this->psrDependencies,
            $this->primaryDependencies,
        );

        $request  = $getTransactionRequestFactory->createRequest($getTransactionRequestData);
        $response = $this->sendRequest($request);

        $transactionResponseFactory = new TransactionResponseFactory($this->primaryDependencies);

        return $transactionResponseFactory->createResponse($response);
    }
}
