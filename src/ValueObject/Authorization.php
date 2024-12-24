<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final class Authorization
{
    public function __construct(
        #[Assert\NotBlank]
        private readonly string $amount,

        #[Assert\NotBlank]
        private readonly string $currency,

        #[Assert\NotBlank]
        private readonly ?string $sessionId = null
    ) {
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }
}
