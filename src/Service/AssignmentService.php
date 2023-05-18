<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\AssignmentRepository;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use App\Validator\Validator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AssignmentService
{
    private AssignmentRepository $assignmentRepository;

    private EmployeeRepository $employeeRepository;

    private CompanyRepository $companyRepository;

    private Validator $validator;

    public function __construct(
        AssignmentRepository $assignmentRepository,
        EmployeeRepository $employeeRepository,
        CompanyRepository $companyRepository,
        Validator $validator,
    ) {
        $this->assignmentRepository = $assignmentRepository;
        $this->employeeRepository = $employeeRepository;
        $this->companyRepository = $companyRepository;
        $this->validator = $validator;
    }
    public function assignEmployeeToCompany(int $employeeId, int $companyId): void
    {
        $this->throwIfEmployeeNotExists($employeeId);

        $this->throwIfCompanyNotExists($companyId);

        $this->throwIfEmployeeCompanyAssignmentAlreadyExists($employeeId, $companyId);

        $this->assignmentRepository->assignEmployeeToCompany($employeeId, $companyId);
    }

    public function deleteEmployeeCompanyAssignment(int $employeeId, int $companyId): void
    {
        $this->throwIfEmployeeNotExists($employeeId);

        $this->throwIfCompanyNotExists($companyId);

        $this->throwIfEmployeeCompanyAssignmentNotExists($employeeId, $companyId);

        $this->assignmentRepository->deleteEmployeeCompanyAssignment($employeeId, $companyId);
    }

    private function throwIfEmployeeCompanyAssignmentAlreadyExists(int $employeeId, int $companyId): void
    {
        if (
            $this->assignmentRepository->doesEmployeeCompanyAssignmentExist($employeeId, $companyId)
        ) {
            throw new BadRequestException(
                'Employee assigned to company!'
            );
        }
    }

    private function throwIfEmployeeCompanyAssignmentNotExists(int $employeeId, int $companyId): void
    {
        if (
            !$this->assignmentRepository->doesEmployeeCompanyAssignmentExist($employeeId, $companyId)
        ) {
            throw new BadRequestException(
                'Assignment not exists!'
            );
        }
    }

    public function throwIfCompanyNotExists(int $companyId): void
    {
        if (
            !$this->companyRepository->doesCompanyExists($companyId)
        ) {
            throw new BadRequestException(
                'Company not exists!'
            );
        }
    }

    public function throwIfEmployeeNotExists(int $employeeId): void
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