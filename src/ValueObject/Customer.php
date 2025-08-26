<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use JLanky\ZenPayments\Enum\ValidationErrorMessages;
use Symfony\Component\Validator\Constraints as Assert;

final class Customer
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email(message: ValidationErrorMessages::INVALID_EMAIL)]
        private readonly string  $email,
        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::CUSTOMER_ID_INVALID)]
        private readonly ?string $id = null,
        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::USER_ID_INVALID)]
        private readonly ?string  $userId = null,
        #[Assert\Positive(message: ValidationErrorMessages::TENANT_ID_MUST_BE_POSITIVE)]
        private readonly ?int     $tenantId = null,
        #[Assert\Length(min: 1, max: 100)]
        #[Assert\Regex(pattern: '/^[a-zA-Z\s]+$/', message: ValidationErrorMessages::FIRST_NAME_INVALID)]
        private readonly ?string  $firstName = null,
        #[Assert\Length(min: 1, max: 100)]
        #[Assert\Regex(pattern: '/^[a-zA-Z\s]+$/', message: ValidationErrorMessages::LAST_NAME_INVALID)]
        private readonly ?string  $lastName = null,
        #[Assert\Regex(pattern: '/^\+?[1-9]\d{1,14}$/', message: ValidationErrorMessages::INVALID_PHONE)]
        private readonly ?string  $phone = null,
        #[Assert\Length(max: 1000)]
        private readonly ?string $information = null,
        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::ACCOUNT_ID_INVALID)]
        private readonly ?string $accountId = null,
        #[Assert\Ip(message: ValidationErrorMessages::INVALID_IP)]
        private readonly ?string $ip = null
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getTenantId(): ?int
    {
        return $this->tenantId;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }
}
