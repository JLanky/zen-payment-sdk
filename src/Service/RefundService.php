<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Service;

use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Request\Refund\CreateRefundTransactionRequestData;
use JLanky\ZenPayments\Request\Refund\CreateRefundTransactionRequestFactory;
use JLanky\ZenPayments\Response\TransactionResponseData;
use JLanky\ZenPayments\Response\TransactionResponseFactory;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class RefundService extends AbstractService
{
    public function __construct(
        private readonly AbstractEnvironment          $environment,
        private readonly PsrDependenciesInterface     $psrDependencies,
        private readonly PrimaryDependenciesInterface $primaryDependencies,
    ) {
        parent::__construct($psrDependencies);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function createTransaction(CreateRefundTransactionRequestData $createRefundTransactionRequestData): TransactionResponseData
    {
        $createRefundTransactionRequestFactory = new CreateRefundTransactionRequestFactory(
            $this->environment,
            $this->psrDependencies,
            $this->primaryDependencies,
        );

        $request = $createRefundTransactionRequestFactory->createRequest($createRefundTransactionRequestData);
        $response = $this->sendRequest($request);

        $transactionResponseFactory = new TransactionResponseFactory($this->primaryDependencies);

        return $transactionResponseFactory->createResponse($response);
    }
}
