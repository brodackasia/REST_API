<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CreateEmployeeCommand;
use App\Command\UpdateEmployeeCommand;
use App\DTO\EmployeeDTO;
use App\Repository\CompanyRepository;
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
        $this->throwIfEmployeeNotExists($employeeId);
        
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

    public function updateEmployee(UpdateEmployeeCommand $updateEmployeeCommand): void
    {
        $this->throwIfEmployeeNotExists(
            (int) $updateEmployeeCommand->getEmployeeId()
        );
        
        $this->validator->validate($updateEmployeeCommand);

        $this->employeeRepository->updateEmployeeData($updateEmployeeCommand);
    }

    public function deleteEmployee(int $employeeId): void
    {
        $this->throwIfEmployeeNotExists($employeeId);
        
        $this->throwIfEmployeeStillAssigned($employeeId);
        
        $this->employeeRepository->deleteEmployeeData($employeeId);
    }

    private function throwIfEmployeeStillAssigned(int $employeeId): void
    {
        if (
            $this->employeeRepository->isEmployeeAssigned($employeeId)
        ) {
            throw new BadRequestException(
                'Employee assigned to company!'
            );
        }
    }

    private function throwIfEmployeeNotExists(int $employeeId): void
    {
        if (
            !$this->employeeRepository->doesEmployeeExist($employeeId)
        ) {
            throw new BadRequestException(
                'Employee not exists!'
            );
        }
    }
}
