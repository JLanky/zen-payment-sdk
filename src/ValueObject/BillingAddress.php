<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final class BillingAddress
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
        private readonly string $country,
        #[Assert\NotBlank]
        private readonly string $street,
        #[Assert\NotBlank]
        private readonly string $city,
        #[Assert\NotBlank]
        private readonly string $countryState,
        #[Assert\NotBlank]
        private readonly string $postcode,
        #[Assert\NotBlank]
        private readonly string $companyName,
        #[Assert\NotBlank]
        private readonly string $phone,
        #[Assert\NotBlank]
        private readonly string $taxId
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

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountryState(): string
    {
        return $this->countryState;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getTaxId(): string
    {
        return $this->taxId;
    }
}
