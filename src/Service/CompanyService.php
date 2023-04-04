<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CompanyDTO;
use App\Repository\CompanyRepository;

class CompanyService
{
    private CompanyRepository $companyRepository;

    function __construct(CompanyRepository $companyRepository)
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
}
