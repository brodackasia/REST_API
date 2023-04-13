<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\EmployeeCommand;
use App\DTO\EmployeeDTO;
use App\Repository\EmployeeRepository;

class EmployeeService
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getEmployee(int $employeeId): EmployeeDTO
    {
        return $this->employeeRepository->getEmployeeData($employeeId);
    }

    public function getEmployees(): array
    {
        return $this->employeeRepository->getEmployeesData();
    }

    public function createEmployee(EmployeeCommand $employeeCommand): int
    {
        return $this->employeeRepository->createEmployeeData($employeeCommand);
    }
}
