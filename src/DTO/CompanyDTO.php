<?php

declare(strict_types=1);

namespace App\DTO;

use JsonSerializable;

class CompanyDTO implements JsonSerializable
{
    private int $companyId;

    private string $companyName;

    private string $companyVatIdentificationNumber;

    private string $companyAddress;

    private string $companyCity;

    private string $companyZipCode;

    function __construct(
        int $companyId,
        string $companyName,
        string $companyAddress,
        string $companyCity,
        string $companyVatIdentificationNumber,
        string $companyZipCode
    ) {
        $this->companyId = $companyId;
        $this->companyName = $companyName;
        $this->companyAddress = $companyAddress;
        $this->companyCity = $companyCity;
        $this->companyVatIdentificationNumber = $companyVatIdentificationNumber;
        $this->companyZipCode = $companyZipCode;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
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

    public function jsonSerialize(): array
    {
        return [
            'companyId' => $this->getCompanyId(),
            'companyName' => $this->getCompanyName(),
            'companyVatIdentificationNumber' => $this->getCompanyVatIdentificationNumber(),
            'companyAddress' => $this->getCompanyAddress(),
            'companyCity' => $this->getCompanyCity(),
            'companyZipCode' => $this->getCompanyZipCode(),
        ];
    }

}
