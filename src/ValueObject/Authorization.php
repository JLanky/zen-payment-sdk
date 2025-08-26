<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use JLanky\ZenPayments\Enum\ValidationErrorMessages;
use Symfony\Component\Validator\Constraints as Assert;

final class Authorization
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^\d+(\.\d{1,2})?$/', message: ValidationErrorMessages::INVALID_AMOUNT_FORMAT)]
        #[Assert\Positive(message: ValidationErrorMessages::AMOUNT_MUST_BE_POSITIVE)]
        private readonly string $amount,
        #[Assert\NotBlank]
        #[Assert\Currency(message: ValidationErrorMessages::INVALID_CURRENCY)]
        private readonly string $currency,
        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::SESSION_ID_INVALID)]
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
