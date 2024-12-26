<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final class Customer
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        private readonly string  $email,
        #[Assert\NotBlank]
        private readonly ?string $id = null,
        #[Assert\NotBlank]
        private readonly ?string  $userId = null,
        #[Assert\NotBlank]
        private readonly ?int     $tenantId = null,
        #[Assert\NotBlank]
        private readonly ?string  $firstName = null,
        #[Assert\NotBlank]
        private readonly ?string  $lastName = null,
        #[Assert\NotBlank]
        private readonly ?string  $phone = null,
        #[Assert\NotBlank]
        private readonly ?string $information = null,
        #[Assert\NotBlank]
        private readonly ?string $accountId = null,
        #[Assert\NotBlank]
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
