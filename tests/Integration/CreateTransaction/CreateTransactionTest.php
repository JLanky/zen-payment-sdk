<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Integration\CreateTransaction;

use Exception;
use Faker\Factory;
use JLanky\ZenPayments\Request\Purchase\CreateTransaction\CreateTransactionRequestData;
use JLanky\ZenPayments\Response\TransactionResponseData;
use JLanky\ZenPayments\Service\PurchaseService;
use JLanky\ZenPayments\Tests\Integration\ZenIntegrationTestCase;
use JLanky\ZenPayments\ValueObject\Authorization;
use JLanky\ZenPayments\ValueObject\Customer;
use JLanky\ZenPayments\ValueObject\Source;
use Psr\Http\Client\ClientExceptionInterface;

class CreateTransactionTest extends ZenIntegrationTestCase
{
    /**
     * @test
     * @dataProvider getTestData
     *
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function testCreateTransactionSuccessfully(CreateTransactionRequestData $createTransactionRequestData): void
    {
        /** @var PurchaseService $zenService */
        $zenService = $this->container->get(PurchaseService::class);

        $responseData = $zenService->createTransaction($createTransactionRequestData);

        $this->assertInstanceOf(TransactionResponseData::class, $responseData);
    }

    public static function getTestData(): array
    {
        $faker = Factory::create();

        $authorization = new Authorization(
            amount: (string) $faker->randomFloat(2, 10, 1000),
            currency: 'USD'
        );

        $source = new Source(
            channel: 'TEST_CHANNEL'
        );

        $customer = new Customer(email: $faker->email);

        $createTransactionRequestData = new CreateTransactionRequestData(
            authorization: $authorization,
            source: $source,
            merchantTransactionId: $faker->uuid,
            paymentChannel: 'PCL_CARD',
            amount: (string) $faker->randomFloat(2, 10, 1000),
            currency: 'USD',
            customer: $customer
        );

        return [
            [$createTransactionRequestData],
        ];
    }
}
