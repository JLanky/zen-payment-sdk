<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final class Customer
{
    public function __construct(
        #[Assert\NotBlank]
        private readonly string $id,
        #[Assert\NotBlank]
        private readonly string $userId,
        #[Assert\NotBlank]
        private readonly int $tenantId,
        #[Assert\NotBlank]
        private readonly string $firstName,
        #[Assert\NotBlank]
        private readonly string $lastName,
        #[Assert\NotBlank]
        #[Assert\Email]
        private readonly string $email,
        #[Assert\NotBlank]
        private readonly string $phone,
        #[Assert\NotBlank]
        private readonly string $information,
        #[Assert\NotBlank]
        private readonly string $accountId,
        #[Assert\NotBlank]
        private readonly string $ip
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getTenantId(): int
    {
        return $this->tenantId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getInformation(): string
    {
        return $this->information;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
