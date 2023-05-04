<?php

declare(strict_types=1);

namespace App\Command;

class CreateCompanyCommand
{
    public function __construct(
        private readonly string $name,
        private readonly string $vatIdentificationNumber,
        private readonly string $address,
        private readonly string $city,
        private readonly string $zipCode
    ) {
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
