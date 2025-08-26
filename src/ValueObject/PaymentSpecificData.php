<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use JLanky\ZenPayments\Enum\ValidationChoices;
use JLanky\ZenPayments\Enum\ValidationErrorMessages;
use Symfony\Component\Validator\Constraints as Assert;

class PaymentSpecificData
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 25, max: 36)]
        public readonly string $payoutBtcAddress,
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ValidationChoices::FEE_OWNERS, message: ValidationErrorMessages::INVALID_FEE_OWNER)]
        public readonly string $feeOwner,
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ValidationChoices::PAYOUT_TYPES, message: ValidationErrorMessages::INVALID_TYPE)]
        public readonly string $type
    ) {
    }

    public function getPayoutBtcAddress(): string
    {
        return $this->payoutBtcAddress;
    }

    public function getFeeOwner(): string
    {
        return $this->feeOwner;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
