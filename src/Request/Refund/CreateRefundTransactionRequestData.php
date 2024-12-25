<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Refund;

use JLanky\ZenPayments\Request\RequestDataInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateRefundTransactionRequestData implements RequestDataInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Uuid]
        public readonly string $transactionId,

        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$/', message: 'Invalid amount format.')]
        public readonly string $amount,

        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 3)]
        #[Assert\Regex(pattern: '/^[A-Z]+$/', message: 'Currency must be in ISO 4217 format.')]
        public readonly string $currency,

        #[Assert\NotBlank]
        #[Assert\Uuid]
        public readonly string $merchantTransactionId,

    ) {}

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getMerchantTransactionId(): string
    {
        return $this->merchantTransactionId;
    }
}
