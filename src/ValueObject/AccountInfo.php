<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

class AccountInfo
{
    public function __construct(
        #[Assert\NotBlank]
        private readonly string $chAccAgeInd,
        #[Assert\NotBlank]
        private readonly string $chAccChange,
        #[Assert\NotBlank]
        private readonly string $chAccChangeInd,
        #[Assert\NotBlank]
        private readonly string $chAccDate,
        #[Assert\NotBlank]
        private readonly string $chAccPwChange,
        #[Assert\NotBlank]
        private readonly string $chAccPwChangeInd,
        #[Assert\NotBlank]
        private readonly string $nbPurchaseAccount,
        #[Assert\NotBlank]
        private readonly string $paymentAccAge,
        #[Assert\NotBlank]
        private readonly string $paymentAccInd,
        #[Assert\NotBlank]
        private readonly string $txnActivityDay,
        #[Assert\NotBlank]
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
