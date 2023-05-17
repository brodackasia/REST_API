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
        return $this->companyRepository->getCompanyData($companyId)
            ?? throw new BadRequestException(
                'Company not exists!'
            );
    }

    public function getCompanies(): array
    {
        return $this->companyRepository->getCompaniesData();
    }

    public function createCompany(CreateCompanyCommand $createCompanyCommand): int
    {
        $this->validator->validate($createCompanyCommand);

        if (
            $this->companyRepository->doesVatIdentificationNumberExists($createCompanyCommand->getVatIdentificationNumber())
        ) {
            throw new BadRequestException('Vat Identification Number must be unique!');
        }

        return $this->companyRepository->createCompanyData($createCompanyCommand);
    }

    public function updateCompany(UpdateCompanyCommand $updateCompanyCommand): void
    {
        $this->validator->validate($updateCompanyCommand);

        if (
            $this->companyRepository->doesVatIdentificationNumberExists($updateCompanyCommand->getVatIdentificationNumber())
        ) {
            throw new BadRequestException('Vat Identification Number must be unique!');
        }

        if (
            !$this->companyRepository->updateCompanyData($updateCompanyCommand)
        ) {
            throw new BadRequestException(
                'Company not exists!'
            );
        }
    }

    public function deleteCompany(int $companyId): void
    {
        if (
            !$this->companyRepository->deleteCompanyData($companyId)
        ) {
            throw new BadRequestException(
                'Company not exists!'
            );
        }
    }
}
