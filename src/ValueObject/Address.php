<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\ValueObject;

use JLanky\ZenPayments\Enum\ValidationErrorMessages;
use Symfony\Component\Validator\Constraints as Assert;

final class Address
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Regex(pattern: '/^[a-zA-Z0-9_-]+$/', message: ValidationErrorMessages::INVALID_ALPHANUMERIC)]
        private readonly string $id,
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 100)]
        #[Assert\Regex(pattern: '/^[a-zA-Z\s]+$/', message: ValidationErrorMessages::INVALID_LETTERS_AND_SPACES)]
        private readonly string $firstName,
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 100)]
        #[Assert\Regex(pattern: '/^[a-zA-Z\s]+$/', message: ValidationErrorMessages::INVALID_LETTERS_AND_SPACES)]
        private readonly string $lastName,
        #[Assert\NotBlank]
        #[Assert\Length(exactly: 2)]
        #[Assert\Regex(pattern: '/^[A-Z]{2}$/', message: ValidationErrorMessages::INVALID_COUNTRY_FORMAT)]
        private readonly string $country,
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        private readonly string $street,
        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 255)]
        private readonly string $city,
        #[Assert\Length(min: 1, max: 255)]
        private readonly ?string $countryState = null,
        #[Assert\Length(min: 1, max: 255)]
        private readonly ?string $province = null,
        #[Assert\Length(min: 1, max: 50)]
        private readonly ?string $buildingNumber = null,
        #[Assert\Length(min: 1, max: 50)]
        private readonly ?string $roomNumber = null,
        #[Assert\Length(min: 1, max: 20)]
        #[Assert\Regex(pattern: '/^[0-9A-Z\s-]+$/i', message: ValidationErrorMessages::INVALID_POSTCODE_FORMAT)]
        private readonly ?string $postcode = null,
        #[Assert\Length(min: 1, max: 255)]
        private readonly ?string $companyName = null,
        #[Assert\Regex(pattern: '/^\+?[1-9]\d{1,14}$/', message: ValidationErrorMessages::INVALID_PHONE)]
        private readonly ?string $phone = null,
        #[Assert\Length(min: 1, max: 50)]
        #[Assert\Regex(pattern: '/^[0-9A-Z\s-]+$/i', message: ValidationErrorMessages::INVALID_TAX_ID_FORMAT)]
        private readonly ?string $taxId = null
    ) {
    }

    public function getId(): string
    {
        return $this->id;
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

    public function getCountryState(): ?string
    {
        return $this->countryState;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    public function getRoomNumber(): ?string
    {
        return $this->roomNumber;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getTaxId(): ?string
    {
        return $this->taxId;
    }
}
