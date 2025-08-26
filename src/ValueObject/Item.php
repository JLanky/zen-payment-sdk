<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use JLanky\ZenPayments\Enum\ValidationErrorMessages;
use Symfony\Component\Validator\Constraints as Assert;

final class Item
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::INVALID_ALPHANUMERIC)]
        private readonly string $code,
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::INVALID_ALPHANUMERIC)]
        private readonly string $category,
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        private readonly string $name,
        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^\d+(\.\d{1,2})?$/', message: ValidationErrorMessages::INVALID_AMOUNT_FORMAT)]
        #[Assert\Positive(message: ValidationErrorMessages::AMOUNT_MUST_BE_POSITIVE)]
        private readonly string $price,
        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^\d+$/', message: ValidationErrorMessages::INVALID_POSITIVE_INTEGER)]
        #[Assert\Positive(message: ValidationErrorMessages::AMOUNT_MUST_BE_POSITIVE)]
        private readonly string $quantity,
        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^\d+(\.\d{1,2})?$/', message: ValidationErrorMessages::INVALID_AMOUNT_FORMAT)]
        #[Assert\Positive(message: ValidationErrorMessages::AMOUNT_MUST_BE_POSITIVE)]
        private readonly string $lineAmountTotal
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

    public function getLineAmountTotal(): string
    {
        return $this->lineAmountTotal;
    }
}
