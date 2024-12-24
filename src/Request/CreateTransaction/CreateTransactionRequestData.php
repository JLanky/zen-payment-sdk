<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\CreateTransaction;

use JLanky\ZenPayments\Request\RequestDataInterface;
use JLanky\ZenPayments\ValueObject\Authorization;
use JLanky\ZenPayments\ValueObject\Source;
use Symfony\Component\Validator\Constraints as Assert;

class CreateTransactionRequestData implements RequestDataInterface
{
    public function __construct(
        #[Assert\NotBlank]
        private readonly Authorization $authorization,

        #[Assert\NotBlank]
        private readonly Source $source,

        #[Assert\NotBlank]
        private readonly string $merchantTransactionId,

        #[Assert\NotBlank]
        private readonly string $paymentChannel,

        #[Assert\NotBlank]
        private readonly string $amount,

        #[Assert\NotBlank]
        private readonly string $currency
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
