<?php

declare(strict_types=1);

namespace App\DTO;

use JsonSerializable;

class CompanyDTO implements JsonSerializable
{
    public function __construct(
        private readonly int $companyId,
        private readonly string $companyName,
        private readonly string $companyVatIdentificationNumber,
        private readonly string $companyAddress,
        private readonly string $companyCity,
        private readonly string $companyZipCode,
        private readonly array $employeesIds
    ) {
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

    public function getEmployeesIds(): array
    {
        return $this->employeesIds;
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
            'employeesIds' => $this->getEmployeesIds(),
        ];
    }
}
