<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CreateCompanyCommand;
use App\Command\UpdateCompanyCommand;
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

    public function createCompany(CreateCompanyCommand $createCompanyCommand): int
    {
         return $this->companyRepository->createCompanyData($createCompanyCommand);
    }

    public function updateCompany(UpdateCompanyCommand $updateCompanyCommand): void
    {
        $this->companyRepository->updateCompanyData($updateCompanyCommand);
    }
}
