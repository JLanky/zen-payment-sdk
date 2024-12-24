<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Service;

use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Request\CreateTransaction\CreateTransactionRequestData;
use JLanky\ZenPayments\Request\CreateTransaction\CreateTransactionRequestFactory;
use JLanky\ZenPayments\Response\CreateTransaction\CreateTransactionResponseData;
use JLanky\ZenPayments\Response\CreateTransaction\CreateTransactionResponseFactory;
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
    public function createTransaction(CreateTransactionRequestData $createTransactionRequestData): CreateTransactionResponseData
    {
        $createTransactionRequestFactory = new CreateTransactionRequestFactory(
            $this->environment,
            $this->psrDependencies,
            $this->primaryDependencies,
        );

        $request = $createTransactionRequestFactory->createRequest($createTransactionRequestData);

        $response = $this->sendRequest($request);

        $createTransactionResponseFactory = new CreateTransactionResponseFactory($this->primaryDependencies);

        return $createTransactionResponseFactory->createResponse($response);
    }
}
