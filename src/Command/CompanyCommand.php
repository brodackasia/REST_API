<?php

declare(strict_types=1);

namespace App\Command;

class CompanyCommand
{
    private string $companyName;

    private string $companyVatIdentificationNumber;

    private string $companyAddress;

    private string $companyCity;

    private string $companyZipCode;

    public function __construct(
        string $companyName,
        string $companyVatIdentificationNumber,
        string $companyAddress,
        string $companyCity,
        string $companyZipCode
    ) {
        $this->companyName = $companyName;
        $this->companyVatIdentificationNumber = $companyVatIdentificationNumber;
        $this->companyAddress = $companyAddress;
        $this->companyCity = $companyCity;
        $this->companyZipCode = $companyZipCode;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getCompanyVatIdentificationNumber(): string
    {
        return $this->companyVatIdentificationNumber;
    }

    public function getCompanyAddress(): string
    {
        return $this->companyAddress;
    }

    public function getCompanyCity(): string
    {
        return $this->companyCity;
    }

    public function getCompanyZipCode(): string
    {
        return $this->companyZipCode;
    }
}
