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

    public function getEmployee(int $employeeId): ?EmployeeDTO
    {
        return $this->employeeRepository->getEmployeeData($employeeId)
            ?: throw new BadRequestException(
                'This employee id not exists!'
            );
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

    public function updateEmployee(UpdateEmployeeCommand $updateEmployeeCommand): void
    {
        if (
            !$this->employeeRepository->updateEmployeeData($updateEmployeeCommand)
        ) {
            throw new BadRequestException(
                'This employee id not exists!'
            );
        }

        $this->validator->validate($updateEmployeeCommand);

        $this->employeeRepository->updateEmployeeData($updateEmployeeCommand);
    }

    public function deleteEmployee(int $employeeId): void
    {

        if ($this->employeeRepository->isEmployeeAssigned($employeeId))
        {
            throw new BadRequestException(
                'Cannot delete, employee assigned to company!'
            );
        }

        if (
            !$this->employeeRepository->deleteEmployeeData($employeeId)
        ) {
            throw new BadRequestException(
                'This employee id not exists!'
            );
        }

        $this->employeeRepository->deleteEmployeeData($employeeId);
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
            throw new BadRequestException('This employee not exists!');
        } else if(
            !$this->employeeRepository->doesCompanyExists($companyId)
        ) {
            throw new BadRequestException('This company not exists!');
        } else if(
            $this->employeeRepository->doesEmployeeCompanyAssignmentExist($employeeId, $companyId)
        ) {
            throw new BadRequestException('This assignment already exists!');
        }
    }
}
