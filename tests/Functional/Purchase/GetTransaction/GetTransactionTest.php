<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Functional\Purchase\GetTransaction;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use JLanky\ZenPayments\Request\Purchase\GetTransaction\GetTransactionRequestData;
use JLanky\ZenPayments\Tests\Functional\Enum\ResponseBodyEnum;
use JLanky\ZenPayments\Tests\Functional\ZenFunctionalTestCase;
use Psr\Http\Client\ClientExceptionInterface;

class GetTransactionTest extends ZenFunctionalTestCase
{
    /**
     * @test
     *
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    #[NoReturn]
    public function testGetTransactionSuccessfully(): void
    {
        $purchaseService = $this->getPurchaseService(ResponseBodyEnum::TransactionResponse->value);

        $getTransactionRequestData = new GetTransactionRequestData(ResponseBodyEnum::TransactionId->value);
        $responseData              = $purchaseService->getTransaction($getTransactionRequestData);

        $this->assertSame(ResponseBodyEnum::TransactionId->value, $responseData->getId());
        $this->assertSame(ResponseBodyEnum::MerchantTransactionId->value, $responseData->getMerchantTransactionId());
        $this->assertSame(ResponseBodyEnum::Amount->value, $responseData->getAmount());
        $this->assertSame(ResponseBodyEnum::CurrencyPln->value, $responseData->getCurrency());
        $this->assertSame(ResponseBodyEnum::StatusAccepted->value, $responseData->getStatus());
        $this->assertSame(ResponseBodyEnum::TypeTrtRefund->value, $responseData->getType());
        $this->assertSame(ResponseBodyEnum::PaymentChannel->value, $responseData->getPaymentChannel());
    }

}
