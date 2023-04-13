<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CompanyCommand;
use App\DTO\CompanyDTO;
use App\Repository\CompanyRepository;

class CompanyService
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getCompany(int $companyId): CompanyDTO
    {
        return $this->companyRepository->getCompanyData($companyId);
    }

    public function getCompanies(): array
    {
        return $this->companyRepository->getCompaniesData();
    }

    public function createCompany(CompanyCommand $companyCommand): int
    {
         return $this->companyRepository->createCompanyData($companyCommand);
    }

    public function updateCompany(int $companyId, CompanyCommand $companyCommand): void
    {
        $this->companyRepository->updateCompanyData($companyId, $companyCommand);
    }
}
