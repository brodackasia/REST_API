<?php

declare(strict_types=1);

namespace App\DTO;

use JsonSerializable;

readonly class CompanyDTO implements JsonSerializable
{
    public function __construct(
        public int $companyId,
        public string $companyName,
        public string $companyVatIdentificationNumber,
        public string $companyAddress,
        public string $companyCity,
        public string $companyZipCode,
        public array $employeesIds,
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'companyId' => $this->companyId,
            'companyName' => $this->companyName,
            'companyVatIdentificationNumber' => $this->companyVatIdentificationNumber,
            'companyAddress' => $this->companyAddress,
            'companyCity' => $this->companyCity,
            'companyZipCode' => $this->companyZipCode,
            'employeesIds' => $this->employeesIds,
        ];
    }
}
