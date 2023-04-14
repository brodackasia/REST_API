<?php

declare(strict_types=1);

namespace App\Command;

class UpdateCompanyCommand
{
    private string $name;

    private string $vatIdentificationNumber;

    private string $address;

    private string $city;

    private string $zip_code;

    private string $companyId;

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

    public function setZipCode(string $zip_code): UpdateCompanyCommand
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    public function setCompanyId(string $companyId): UpdateCompanyCommand
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
        return $this->zip_code;
    }

    public function getCompanyId(): string
    {
        return $this->companyId;
    }
}
