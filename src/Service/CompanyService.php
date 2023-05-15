<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CreateCompanyCommand;
use App\Command\UpdateCompanyCommand;
use App\DTO\CompanyDTO;
use App\Repository\CompanyRepository;
use App\Validator\Validator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CompanyService
{
    private CompanyRepository $companyRepository;

    private Validator $validator;

    public function __construct(CompanyRepository $companyRepository, Validator $validator)
    {
        $this->companyRepository = $companyRepository;
        $this->validator = $validator;
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
        $this->validator->validate($createCompanyCommand);

        return $this->companyRepository->createCompanyData($createCompanyCommand);
    }

    public function updateCompany(UpdateCompanyCommand $updateCompanyCommand): void
    {
        $this->validator->validate($updateCompanyCommand);

        $this->companyRepository->updateCompanyData($updateCompanyCommand);
    }

    public function deleteCompany(int $companyId): void
    {
        $this->companyRepository->deleteCompanyData($companyId);
    }

    public function vatIdentificationNumberValidation(array $companyData): void
    {
        if(
            $this->companyRepository->doesVatIdentificationNumberExists($companyData['vat_identification_number'])
        ) {
            throw new BadRequestException('Vat Identification Number must be unique!');
        }
    }
}
