<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CreateEmployeeCommand;
use App\Command\UpdateEmployeeCommand;
use App\DTO\EmployeeDTO;
use App\Repository\EmployeeRepository;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EmployeeService
{
    private EmployeeRepository $employeeRepository;

    private ValidatorInterface $validator;

    public function __construct(EmployeeRepository $employeeRepository, ValidatorInterface $validator)
    {
        $this->employeeRepository = $employeeRepository;
        $this->validator = $validator;
    }

    public function getEmployee(int $employeeId): EmployeeDTO
    {
        return $this->employeeRepository->getEmployeeData($employeeId);
    }

    public function getEmployees(): array
    {
        return $this->employeeRepository->getEmployeesData();
    }

    public function createEmployee(CreateEmployeeCommand $createEmployeeCommand): int
    {
        $this->validatePostRequestParameters($createEmployeeCommand);

        return $this->employeeRepository->createEmployeeData($createEmployeeCommand);
    }

    public function updateEmployee(UpdateEmployeeCommand $updateEmployeeCommand): void
    {
        $this->validatePutRequestParameters($updateEmployeeCommand);

        $this->employeeRepository->updateEmployeeData($updateEmployeeCommand);
    }

    public function deleteEmployee(int $companyId): ?int
    {
        return $this->validateDeleteRequest($this->employeeRepository->deleteEmployeeData($companyId));
    }

    public function assignEmployeeToCompany(int $employeeId, int $companyId): void
    {
        $this->employeeRepository->assignEmployeeToCompany($employeeId, $companyId);
    }

    private function validateDeleteRequest(?int $deletedEmployeeId): ?string
    {
        if (
            !(isset($deletedEmployeeId))
        ) {
            throw new Exception(
                'There is no record with the specified id in the database'
            );
        }

        return null;
    }

    private function validatePostRequestParameters(CreateEmployeeCommand $createEmployeeCommand): ?string
    {
        $violationList = $this->validator->validate($createEmployeeCommand);

        if (count($violationList) > 0) {
            throw new Exception(
                $violationList[0]->getMessageTemplate()
            );
        }

        return null;
    }

    private function validatePutRequestParameters(UpdateEmployeeCommand $updateEmployeeCommand): ?string
    {
        $violationList = $this->validator->validate($updateEmployeeCommand);

        if (count($violationList) > 0) {
            throw new Exception(
                $violationList[0]->getMessageTemplate()
            );
        }

        return null;
    }
}
