<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CreateEmployeeCommand;
use App\Command\UpdateEmployeeCommand;
use App\DTO\EmployeeDTO;
use App\Repository\EmployeeRepository;
use App\Validator\Validator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class EmployeeService
{
    private EmployeeRepository $employeeRepository;

    private Validator $validator;

    public function __construct(EmployeeRepository $employeeRepository, Validator $validator)
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
        $this->validator->validate($createEmployeeCommand);

        return $this->employeeRepository->createEmployeeData($createEmployeeCommand);
    }

    public function updateEmployee(UpdateEmployeeCommand $updateEmployeeCommand): ?int
    {
        $this->validator->validate($updateEmployeeCommand);

        return $this->employeeRepository->updateEmployeeData($updateEmployeeCommand);
    }

    public function deleteEmployee(int $companyId): ?int
    {
        return $this->employeeRepository->deleteEmployeeData($companyId);
    }

    public function assignEmployeeToCompany(int $employeeId, int $companyId): void
    {
        $this->assignmentValidation($employeeId, $companyId);

        $this->employeeRepository->assignEmployeeToCompany($employeeId, $companyId);
    }

    private function assignmentValidation(int $employeeId, int $companyId): void
    {
        if (
            !$this->employeeRepository->doesEmployeeExist($employeeId)
        ) {
            throw new BadRequestException('this employee not exists');
        } else if(
            !$this->employeeRepository->doesCompanyExists($companyId)
        ) {
            throw new BadRequestException('this company not exists');
        } else if(
            $this->employeeRepository->doesEmployeeCompanyAssignmentExist($employeeId, $companyId)
        ) {
            throw new BadRequestException('this assignment already exists');
        }
    }
}
