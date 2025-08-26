<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Payout\CreateTransaction;

use JLanky\ZenPayments\Enum\ValidationChoices;
use JLanky\ZenPayments\Enum\ValidationErrorMessages;
use JLanky\ZenPayments\Request\RequestDataInterface;
use JLanky\ZenPayments\ValueObject\AccountInfo;
use JLanky\ZenPayments\ValueObject\Authorization;
use JLanky\ZenPayments\ValueObject\Customer;
use JLanky\ZenPayments\ValueObject\PaymentSpecificData;
use JLanky\ZenPayments\ValueObject\Source;
use Symfony\Component\Validator\Constraints as Assert;

class CreatePayoutTransactionRequestData implements RequestDataInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Valid]
        private readonly Authorization $authorization,
        #[Assert\NotBlank]
        #[Assert\Valid]
        private readonly Source $source,
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::MERCHANT_TRANSACTION_ID_INVALID)]
        private readonly string $merchantTransactionId,
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ValidationChoices::PAYMENT_CHANNELS, message: ValidationErrorMessages::INVALID_PAYMENT_CHANNEL)]
        private readonly string $paymentChannel,
        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^\d+(\.\d{1,2})?$/', message: ValidationErrorMessages::INVALID_AMOUNT_FORMAT)]
        #[Assert\Positive(message: ValidationErrorMessages::AMOUNT_MUST_BE_POSITIVE)]
        private readonly string $amount,
        #[Assert\NotBlank]
        #[Assert\Currency(message: ValidationErrorMessages::INVALID_CURRENCY)]
        private readonly string $currency,
        #[Assert\NotBlank]
        #[Assert\Valid]
        private readonly Customer $customer,
        #[Assert\NotBlank]
        #[Assert\Valid]
        private readonly PaymentSpecificData $paymentSpecificData,
        #[Assert\Valid]
        private readonly ?AccountInfo $accountInfo = null
    ) {
    }

    public function getAuthorization(): Authorization
    {
        return $this->authorization;
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getMerchantTransactionId(): string
    {
        return $this->merchantTransactionId;
    }

    public function getPaymentChannel(): string
    {
        return $this->paymentChannel;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getPaymentSpecificData(): PaymentSpecificData
    {
        return $this->paymentSpecificData;
    }

    public function getAccountInfo(): ?AccountInfo
    {
        return $this->accountInfo;
    }
}
