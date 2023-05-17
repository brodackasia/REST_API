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
    
    private CompanyRepository $companyRepository;

    private CompanyService $companyService;

    private Validator $validator;

    public function __construct(
        EmployeeRepository $employeeRepository,
        Validator $validator, 
        CompanyRepository $companyRepository,
        CompanyService $companyService,
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->validator = $validator;
        $this->companyRepository = $companyRepository;
        $this->companyService = $companyService;
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

    public function assignEmployeeToCompany(int $employeeId, int $companyId): void
    {
        $this->throwIfEmployeeNotExists($employeeId);
        
        $this->companyService->throwIfCompanyNotExists($companyId);
        
        $this->throwIfEmployeeCompanyAssignmentAlreadyExists($employeeId, $companyId);
        
        $this->employeeRepository->assignEmployeeToCompany($employeeId, $companyId);
    }

    public function deleteEmployeeCompanyAssignment(int $employeeId, int $companyId): void
    {
        $this->throwIfEmployeeNotExists($employeeId);

        $this->throwIfEmployeeCompanyAssignmentNotExists($employeeId, $companyId);

        $this->employeeRepository->deleteEmployeeCompanyAssignment($employeeId, $companyId);
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

    private function throwIfEmployeeCompanyAssignmentAlreadyExists(int $employeeId, int $companyId): void
    {
        if (
            $this->employeeRepository->doesEmployeeCompanyAssignmentExist($employeeId, $companyId)
        ) {
            throw new BadRequestException(
                'Employee assigned to company!'
            );
        }
    }

    private function throwIfEmployeeCompanyAssignmentNotExists(int $employeeId, int $companyId): void
    {
        if (
            !$this->employeeRepository->doesEmployeeCompanyAssignmentExist($employeeId, $companyId)
        ) {
            throw new BadRequestException(
                'Assignment not exists!'
            );
        }
    }
}
