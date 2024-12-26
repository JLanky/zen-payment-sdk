<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Payout\CreateTransaction;

use JLanky\ZenPayments\Request\RequestDataInterface;
use JLanky\ZenPayments\ValueObject\Customer;
use JLanky\ZenPayments\ValueObject\PaymentSpecificData;
use Symfony\Component\Validator\Constraints as Assert;

class CreatePayoutTransactionRequestData implements RequestDataInterface
{
    public function __construct(
        #[Assert\NotBlank]
        private readonly string $merchantTransactionId,
        #[Assert\NotBlank]
        private readonly string $paymentChannel,
        private readonly string $amount,
        #[Assert\NotBlank]
        private readonly string $currency,
        #[Assert\NotBlank]
        private readonly Customer $customer,
        private readonly PaymentSpecificData $paymentSpecificData
    ) {
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
}
