<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Functional\Refund\CreateTransaction;

use Exception;
use Faker\Factory;
use JetBrains\PhpStorm\NoReturn;
use JLanky\ZenPayments\Request\Purchase\CreateTransaction\CreateTransactionRequestData;
use JLanky\ZenPayments\Request\Refund\CreateRefundTransactionRequestData;
use JLanky\ZenPayments\Tests\Functional\Enum\ResponseBodyEnum;
use JLanky\ZenPayments\Tests\Functional\ZenFunctionalTestCase;
use JLanky\ZenPayments\ValueObject\Authorization;
use JLanky\ZenPayments\ValueObject\Customer;
use JLanky\ZenPayments\ValueObject\Source;
use Psr\Http\Client\ClientExceptionInterface;

class CreateTransactionTest extends ZenFunctionalTestCase
{
    /**
     * @test
     * @dataProvider getTestData
     *
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    #[NoReturn]
    public function testCreateTransactionSuccessfully(CreateRefundTransactionRequestData $createRefundTransactionRequestData): void
    {
        $refundService = $this->getRefundService(ResponseBodyEnum::TransactionResponse->value);

        $responseData = $refundService->createTransaction($createRefundTransactionRequestData);

        $this->assertSame(ResponseBodyEnum::TransactionId->value, $responseData->getId());
        $this->assertSame(ResponseBodyEnum::MerchantTransactionId->value, $responseData->getMerchantTransactionId());
        $this->assertSame(ResponseBodyEnum::Amount->value, $responseData->getAmount());
        $this->assertSame(ResponseBodyEnum::CurrencyPln->value, $responseData->getCurrency());
        $this->assertSame(ResponseBodyEnum::StatusAccepted->value, $responseData->getStatus());
        $this->assertSame(ResponseBodyEnum::TypeTrtRefund->value, $responseData->getType());
        $this->assertSame(ResponseBodyEnum::PaymentChannel->value, $responseData->getPaymentChannel());
    }

    public static function getTestData(): array
    {
        $faker = Factory::create();

        $createTransactionRequestData = new CreateRefundTransactionRequestData(
            transactionId: $faker->uuid,
            amount: (string) $faker->randomFloat(2, 10, 1000),
            currency: 'EUR',
            merchantTransactionId: $faker->uuid,
        );

        return [
            [$createTransactionRequestData],
        ];
    }
}
