<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Purchase\GetTransaction;

use JLanky\ZenPayments\Request\RequestDataInterface;
use Symfony\Component\Serializer\Attribute\SerializedName;

class GetTransactionRequestData implements RequestDataInterface
{
    public function __construct(
        #[SerializedName('id')]
        private readonly string $transactionId
    ) {
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }
}
