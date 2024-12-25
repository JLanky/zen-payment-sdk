# Zen Payments SDK

A simple and robust PHP SDK for integrating with the Zen Payments API. This SDK provides an easy way to interact with Zen Payments' transaction management, including creating purchase transactions, payouts, and refunds.

<span style="color: red;">*Only required fields are used.</span>
## Features

- Create purchase transactions
- Get purchase transactions
- Create payout transactions
- Create refund transactions
- IPN handling (coming soon)
- PSR-12 compliant
- Fully validated with Symfony Validator

## Requirements

- PHP 8.1 or higher
- Composer
- PSR-18 compatible HTTP client (e.g., Guzzle, Symfony HTTP Client)
- PSR-17 implementation for request and stream factories (e.g., `nyholm/psr7`)
- Ext-curl (for making HTTP requests)
- ext-json (for JSON handling)
- Symfony Validator (included in dependencies)

## Installation

Install the SDK using Composer:

```bash
composer require JLanky/zen-payments-sdk
```

### HTTP Client Dependency
This SDK is built on the PSR-18 standard for HTTP client abstraction. You must use an HTTP client and PSR-17 factories to use this SDK.
For example, you can use:

Symfony HTTP Client:
```Bash
composer require symfony/http-client nyholm/psr7
```
Guzzle HTTP Client:
```Bash
composer require guzzlehttp/guzzle http-interop/http-factory-guzzle
```

## Usage

The SDK's services rely on several dependencies to ensure flexibility and compatibility with PSR standards. You must resolve and provide the required dependencies when initializing any service.
Dependencies for services are identical.
Here’s an example of how to resolve dependencies for the `RefundService` and create refund transaction:

```php
use JLanky\ZenPayments\Config\Credentials\ZenCredentials;
use JLanky\ZenPayments\Config\Environment\SandboxEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependencies;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependencies;
use JLanky\ZenPayments\Dependency\Factories\SerializerFactory;
use JLanky\ZenPayments\Dependency\Factories\ValidatorFactory;
use JLanky\ZenPayments\Helper\HashHelper;
use JLanky\ZenPayments\Request\Refund\CreateRefundTransactionRequestData;
use JLanky\ZenPayments\Service\PayoutService;
use JLanky\ZenPayments\Service\PurchaseService;
use JLanky\ZenPayments\Service\RefundService;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\HttpClient\Psr18Client;

// Dependency Injection Example
$refundService = new RefundService(
    new SandboxEnvironment(
        new ZenCredentials('your_ipn_secret', 'your_terminal_api_key') // API Credentials
    ),
    new PsrDependencies(
        new Psr17Factory(), // PSR-17 Request Factory
        new Psr17Factory(), // PSR-17 Stream Factory
        new Psr18Client();// PSR-18 HTTP Client
    ),
    new PrimaryDependencies(
        new ValidatorFactory(),
        new SerializerFactory(),
        new HashHelper()
    );
);

$createRefundTransactionRequestData = new CreateRefundTransactionRequestData(
    transactionId: '75906707-8c31-479c-b354-aa805c4cefbc',
    amount: '100',  
    currency: 'PLN', // Currency code in ISO 4217 alphabetic code
    merchantTransactionId: '23beb187-f8a3-44b8-9ef8-b31180358dd3',
);

$responseData = $refundService->createTransaction($createRefundTransactionRequestData);
```

## Purchase
### Create purchase transaction

```php
use JLanky\ZenPayments\Request\Purchase\CreateTransaction\CreateTransactionRequestData;
use JLanky\ZenPayments\ValueObject\Authorization;
use JLanky\ZenPayments\ValueObject\Customer;
use JLanky\ZenPayments\ValueObject\Source;

$authorization = new Authorization(amount: '1000', currency: 'PLN');
$source        = new Source(channel: 'TEST_CHANNEL');
$customer      = new Customer(email: 'example@gmail.com');

$createTransactionRequestData = new CreateTransactionRequestData(
    authorization: $authorization,
    source: $source,
    merchantTransactionId: '7b219e08-1205-4996-8167-bc6e345435a0',
    paymentChannel: 'PCL_CARD',
    amount: '1000',
    currency: 'PLN',
    customer: $customer
);

$purchaseService->createTransaction($createTransactionRequestData)
```

### Get purchase transaction

```php
use JLanky\ZenPayments\Request\Purchase\GetTransaction\GetTransactionRequestData;

$getTransactionRequestData = new GetTransactionRequestData(transactionId: '7b219e08-1205-4996-8167-bc6e345435a0');

$purchaseService->getTransaction($getTransactionRequestData)
```

## Payout

### Create payout transaction
```php
use JLanky\ZenPayments\Request\Payout\CreateTransaction\CreatePayoutTransactionRequestData;
use JLanky\ZenPayments\ValueObject\Customer;
use JLanky\ZenPayments\ValueObject\PaymentSpecificData;

$paymentSpecificData = new PaymentSpecificData(
    payoutBtcAddress: '1HB5XDDddDDdDDDj6mfBsbifRoD4miY36v',
    feeOwner: 'partner',
    type: 'bitbaywithdrawal'
);

$customer = new Customer(email: 'example@gmail.com');

$createTransactionRequestData = new CreatePayoutTransactionRequestData(
    merchantTransactionId: '8fed8730-3cda-4a84-8735-1a74e20ac007',
    paymentChannel: 'PCL_CARD',
    amount: '1000',
    currency: 'PLN',
    customer: $customer,
    paymentSpecificData: $paymentSpecificData
);

$payoutService->createTransaction($getTransactionRequestData)
```

