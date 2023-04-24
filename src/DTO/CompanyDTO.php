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

    private string $employeesIds;

    public function __construct(
        int $companyId,
        string $companyName,
        string $companyVatIdentificationNumber,
        string $companyAddress,
        string $companyCity,
        string $companyZipCode,
        string $employeesIds
    ) {
        $this->companyId = $companyId;
        $this->companyName = $companyName;
        $this->companyVatIdentificationNumber = $companyVatIdentificationNumber;
        $this->companyAddress = $companyAddress;
        $this->companyCity = $companyCity;
        $this->companyZipCode = $companyZipCode;
        $this->employeesIds = $employeesIds;
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
        return
            array_map(
                'intval',
                explode(
                    ',',
                    str_replace(
                        ['{', '}'],
                        '',
                        $this->employeesIds
                    )
                )
            );
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
