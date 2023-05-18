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
        $this->throwIfCompanyNotExists($companyId);

        return $this->companyRepository->getCompanyData($companyId);
    }

    public function getCompanies(): array
    {
        return $this->companyRepository->getCompaniesData();
    }

    public function createCompany(CreateCompanyCommand $createCompanyCommand): int
    {
        $this->throwIfVatIdentificationNumberAlreadyExists(
            $createCompanyCommand->getVatIdentificationNumber()
        );

        $this->validator->validate($createCompanyCommand);

        return $this->companyRepository->createCompanyData($createCompanyCommand);
    }

    public function updateCompany(UpdateCompanyCommand $updateCompanyCommand): void
    {
        $this->throwIfCompanyNotExists(
            (int) $updateCompanyCommand->getCompanyId()
        );

        $this->throwIfVatIdentificationNumberAlreadyExists(
            $updateCompanyCommand->getVatIdentificationNumber()
        );

        $this->validator->validate($updateCompanyCommand);

        $this->companyRepository->updateCompanyData($updateCompanyCommand);
    }

    public function deleteCompany(int $companyId): void
    {
        $this->throwIfCompanyNotExists($companyId);

        $this->companyRepository->deleteCompanyData($companyId);
    }

    private function throwIfVatIdentificationNumberAlreadyExists(string $vatIdentificationNumber): void
    {
        if (
            $this->companyRepository->doesVatIdentificationNumberExists($vatIdentificationNumber)
        ) {
            throw new BadRequestException(
                'Vat Identification Number must be unique!'
            );
        }
    }

    private function throwIfCompanyNotExists(int $companyId): void
    {
        if (
            !$this->companyRepository->doesCompanyExists($companyId)
        ) {
            throw new BadRequestException(
                'Company not exists!'
            );
        }
    }
}
