<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateCompanyCommand
{
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Company name must be at least 2 characters long!',
        maxMessage: 'Company name cannot be longer than 50 characters!',
    )]
    #[Assert\NotBlank(message: 'Company name must not be blank!')]
    private string $name;

    #[Assert\Regex(
        pattern: '/^\d{10}$/',
        message: 'Company vat identification number must contain 10 digits!',
        match: true
    )]
    #[Assert\NotBlank(message: 'Company vat identification number must not be blank!')]
    private string $vatIdentificationNumber;

    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Company address must be at least 5 characters long!',
        maxMessage: 'Company address cannot be longer than 30 characters!',
    )]
    #[Assert\NotBlank(message: 'Company address must not be blank!')]
    private string $address;

    #[Assert\Length(
        min: 2,
        max: 30,
        minMessage: 'Company city must be at least 2 characters long!',
        maxMessage: 'Company city cannot be longer than 30 characters!',
    )]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Company city cannot contain a number',
        match: false
    )]
    #[Assert\NotBlank(message: 'Company city must not be blank!')]
    private string $city;

    #[Assert\Regex(
        pattern: '/^\d{2}-\d{3}$/',
        message: 'Company zip code must be in format 12-345!',
        match: true
    )]
    #[Assert\NotBlank(message: 'Company zip code must not be blank!')]
    private string $zipCode;

    private int $companyId;

    public function setName(string $name): UpdateCompanyCommand
    {
        $this->name = $name;
        return $this;
    }

    public function setVatIdentificationNumber(string $vatIdentificationNumber): UpdateCompanyCommand
    {
        $this->vatIdentificationNumber = $vatIdentificationNumber;
        return $this;
    }

    public function setAddress(string $address): UpdateCompanyCommand
    {
        $this->address = $address;
        return $this;
    }

    public function setCity(string $city): UpdateCompanyCommand
    {
        $this->city = $city;
        return $this;
    }

    public function setZipCode(string $zipCode): UpdateCompanyCommand
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function setCompanyId(int $companyId): UpdateCompanyCommand
    {
        $this->companyId = $companyId;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVatIdentificationNumber(): string
    {
        return $this->vatIdentificationNumber;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }
}
