<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Response\CreateTransaction;

use JLanky\ZenPayments\Response\ResponseDataInterface;
use Symfony\Component\Serializer\Attribute\SerializedName;

class CreateTransactionResponseData implements ResponseDataInterface
{
    public function __construct(
        private readonly string $id,
        #[SerializedName('merchantTransactionId')]
        private readonly string $merchantTransactionId,
        private readonly string $amount,
        private readonly string $currency,
        private readonly string $status,
        private readonly string $type,
        #[SerializedName('paymentChannel')]
        private readonly string $paymentChannel
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMerchantTransactionId(): string
    {
        return $this->merchantTransactionId;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPaymentChannel(): string
    {
        return $this->paymentChannel;
    }
}
