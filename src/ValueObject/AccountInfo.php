<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use JLanky\ZenPayments\Enum\ValidationChoices;
use JLanky\ZenPayments\Enum\ValidationErrorMessages;
use Symfony\Component\Validator\Constraints as Assert;

class AccountInfo
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ValidationChoices::ACCOUNT_AGE_INDICATORS, message: ValidationErrorMessages::INVALID_ACCOUNT_AGE_INDICATOR)]
        private readonly string $chAccAgeInd,
        #[Assert\NotBlank]
        #[Assert\Date(message: ValidationErrorMessages::ACCOUNT_CHANGE_DATE_INVALID)]
        private readonly string $chAccChange,
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ValidationChoices::ACCOUNT_CHANGE_INDICATORS, message: ValidationErrorMessages::INVALID_ACCOUNT_CHANGE_INDICATOR)]
        private readonly string $chAccChangeInd,
        #[Assert\NotBlank]
        #[Assert\Date(message: ValidationErrorMessages::ACCOUNT_CREATION_DATE_INVALID)]
        private readonly string $chAccDate,
        #[Assert\NotBlank]
        #[Assert\Date(message: ValidationErrorMessages::PASSWORD_CHANGE_DATE_INVALID)]
        private readonly string $chAccPwChange,
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ValidationChoices::PASSWORD_CHANGE_INDICATORS, message: ValidationErrorMessages::INVALID_PASSWORD_CHANGE_INDICATOR)]
        private readonly string $chAccPwChangeInd,
        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^\d+$/', message: ValidationErrorMessages::NUMBER_OF_PURCHASES_INVALID)]
        #[Assert\Positive(message: ValidationErrorMessages::AMOUNT_MUST_BE_POSITIVE)]
        private readonly string $nbPurchaseAccount,
        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^\d+$/', message: ValidationErrorMessages::PAYMENT_ACCOUNT_AGE_INVALID)]
        #[Assert\Positive(message: ValidationErrorMessages::AMOUNT_MUST_BE_POSITIVE)]
        private readonly string $paymentAccAge,
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ValidationChoices::PAYMENT_ACCOUNT_INDICATORS, message: ValidationErrorMessages::INVALID_PAYMENT_ACCOUNT_INDICATOR)]
        private readonly string $paymentAccInd,
        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^\d+$/', message: ValidationErrorMessages::TRANSACTION_ACTIVITY_DAY_INVALID)]
        #[Assert\Positive(message: ValidationErrorMessages::AMOUNT_MUST_BE_POSITIVE)]
        private readonly string $txnActivityDay,
        #[Assert\NotBlank]
        #[Assert\Regex(pattern: '/^\d+$/', message: ValidationErrorMessages::TRANSACTION_ACTIVITY_YEAR_INVALID)]
        #[Assert\Positive(message: ValidationErrorMessages::AMOUNT_MUST_BE_POSITIVE)]
        private readonly string $txnActivityYear
    ) {
    }

    public function getChAccAgeInd(): string
    {
        return $this->chAccAgeInd;
    }

    public function getChAccChange(): string
    {
        return $this->chAccChange;
    }

    public function getChAccChangeInd(): string
    {
        return $this->chAccChangeInd;
    }

    public function getChAccDate(): string
    {
        return $this->chAccDate;
    }

    public function getChAccPwChange(): string
    {
        return $this->chAccPwChange;
    }

    public function getChAccPwChangeInd(): string
    {
        return $this->chAccPwChangeInd;
    }

    public function getNbPurchaseAccount(): string
    {
        return $this->nbPurchaseAccount;
    }

    public function getPaymentAccAge(): string
    {
        return $this->paymentAccAge;
    }

    public function getPaymentAccInd(): string
    {
        return $this->paymentAccInd;
    }

    public function getTxnActivityDay(): string
    {
        return $this->txnActivityDay;
    }

    public function getTxnActivityYear(): string
    {
        return $this->txnActivityYear;
    }
}
