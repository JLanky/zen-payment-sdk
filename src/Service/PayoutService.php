<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Service;

use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Request\Payout\CreateTransaction\CreatePayoutTransactionRequestData;
use JLanky\ZenPayments\Request\Payout\CreateTransaction\CreatePayoutTransactionRequestFactory;
use JLanky\ZenPayments\Response\TransactionResponseData;
use JLanky\ZenPayments\Response\TransactionResponseFactory;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class PayoutService extends AbstractService
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
    public function createTransaction(CreatePayoutTransactionRequestData $createPayoutTransactionRequestData): TransactionResponseData
    {
        $createTransactionRequestFactory = new CreatePayoutTransactionRequestFactory(
            $this->environment,
            $this->psrDependencies,
            $this->primaryDependencies,
        );

        $request  = $createTransactionRequestFactory->createRequest($createPayoutTransactionRequestData);
        $response = $this->sendRequest($request);

        $transactionResponseFactory = new TransactionResponseFactory($this->primaryDependencies);

        return $transactionResponseFactory->createResponse($response);
    }
}
