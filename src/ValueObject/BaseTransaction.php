<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

class BaseTransaction
{
    public function __construct(
        #[Assert\NotBlank]
        protected readonly Authorization $authorization,
        #[Assert\NotBlank]
        protected readonly Source $source,
        #[Assert\NotBlank]
        protected readonly string $merchantTransactionId,
        #[Assert\NotBlank]
        protected readonly string $paymentChannel,
        #[Assert\NotBlank]
        protected readonly string $amount,
        #[Assert\NotBlank]
        protected readonly string $currency
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
}
