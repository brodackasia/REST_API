<?php

declare(strict_types=1);

namespace App\Command;

class CreateCompanyCommand
{
    private string $name;

    private string $vatIdentificationNumber;

    private string $address;

    private string $city;

    private string $zipCode;

    public function __construct(
        string $name,
        string $vatIdentificationNumber,
        string $address,
        string $city,
        string $zipCode
    ) {
        $this->name = $name;
        $this->vatIdentificationNumber = $vatIdentificationNumber;
        $this->address = $address;
        $this->city = $city;
        $this->zipCode = $zipCode;
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
}
