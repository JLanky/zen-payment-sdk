<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Functional\Payout\CreateTransaction;

use Exception;
use Faker\Factory;
use JetBrains\PhpStorm\NoReturn;
use JLanky\ZenPayments\Enum\AccountAgeIndicator;
use JLanky\ZenPayments\Enum\AccountChangeIndicator;
use JLanky\ZenPayments\Enum\FeeOwner;
use JLanky\ZenPayments\Enum\PasswordChangeIndicator;
use JLanky\ZenPayments\Enum\PaymentAccountIndicator;
use JLanky\ZenPayments\Enum\PaymentChannel;
use JLanky\ZenPayments\Enum\PayoutType;
use JLanky\ZenPayments\Enum\SourceChannel;
use JLanky\ZenPayments\Request\Payout\CreateTransaction\CreatePayoutTransactionRequestData;
use JLanky\ZenPayments\Tests\Functional\Enum\ResponseBodyEnum;
use JLanky\ZenPayments\Tests\Functional\ZenFunctionalTestCase;
use JLanky\ZenPayments\ValueObject\AccountInfo;
use JLanky\ZenPayments\ValueObject\Authorization;
use JLanky\ZenPayments\ValueObject\Customer;
use JLanky\ZenPayments\ValueObject\PaymentSpecificData;
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
    public function testCreatePayoutTransactionSuccessfully(CreatePayoutTransactionRequestData $createPayoutTransactionRequestData): void
    {
        $payoutService = $this->getPayoutService(ResponseBodyEnum::TransactionResponse->value);

        $responseData = $payoutService->createTransaction($createPayoutTransactionRequestData);

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

        $authorization = new Authorization(
            amount: (string) $faker->randomFloat(2, 10, 1000),
            currency: 'EUR',
            sessionId: 'session_' . $faker->uuid
        );

        $source = new Source(
            channel: SourceChannel::TEST_CHANNEL->value,
            pluginName: 'TestPlugin',
            pluginVersion: '1.0.0',
            platformName: 'TestPlatform',
            platformVersion: '2.0.0'
        );

        $customer = new Customer(
            email: $faker->email,
            id: 'cust_' . $faker->uuid,
            userId: 'user_' . $faker->uuid,
            tenantId: $faker->numberBetween(1, 100),
            firstName: $faker->firstName,
            lastName: $faker->lastName,
            phone: '+1234567890', // International format
            information: 'Test customer information',
            accountId: 'acc_' . $faker->uuid,
            ip: $faker->ipv4
        );

        $paymentSpecificData = new PaymentSpecificData(
            payoutBtcAddress: '1HB5XDDddDDdDDDj6mfBsbifRoD4miY36v',
            feeOwner: FeeOwner::PARTNER->value,
            type: PayoutType::BITBAY_WITHDRAWAL->value
        );

        $accountInfo = new AccountInfo(
            chAccAgeInd: AccountAgeIndicator::LESS_THAN_30_DAYS->value,
            chAccChange: '2023-01-01',
            chAccChangeInd: AccountChangeIndicator::LESS_THAN_30_DAYS->value,
            chAccDate: '2022-01-01',
            chAccPwChange: '2023-06-01',
            chAccPwChangeInd: PasswordChangeIndicator::LESS_THAN_30_DAYS->value,
            nbPurchaseAccount: '5',
            paymentAccAge: '12',
            paymentAccInd: PaymentAccountIndicator::LESS_THAN_30_DAYS->value,
            txnActivityDay: '10',
            txnActivityYear: '100'
        );

        $createTransactionRequestData = new CreatePayoutTransactionRequestData(
            authorization: $authorization,
            source: $source,
            merchantTransactionId: $faker->uuid,
            paymentChannel: PaymentChannel::CARD->value,
            amount: (string) $faker->randomFloat(2, 10, 1000),
            currency: 'EUR',
            customer: $customer,
            paymentSpecificData: $paymentSpecificData,
            accountInfo: $accountInfo
        );

        return [
            [$createTransactionRequestData],
        ];
    }
}
