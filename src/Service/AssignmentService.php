<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\AssignmentRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

readonly class AssignmentService
{
    public function __construct(
        public AssignmentRepository $assignmentRepository,
        public EmployeeService $employeeService,
        public CompanyService $companyService,
    ) {}

    public function assignEmployeeToCompany(int $employeeId, int $companyId): void
    {
        $this->employeeService->throwIfEmployeeNotExists($employeeId);

        $this->companyService->throwIfCompanyNotExists($companyId);

        $this->throwIfEmployeeCompanyAssignmentAlreadyExists($employeeId, $companyId);

        $this->assignmentRepository->assignEmployeeToCompany($employeeId, $companyId);
    }

    public function deleteEmployeeCompanyAssignment(int $employeeId, int $companyId): void
    {
        $this->employeeService->throwIfEmployeeNotExists($employeeId);

        $this->companyService->throwIfCompanyNotExists($companyId);

        $this->throwIfEmployeeCompanyAssignmentNotExists($employeeId, $companyId);

        $this->assignmentRepository->deleteEmployeeCompanyAssignment($employeeId, $companyId);
    }

    private function throwIfEmployeeCompanyAssignmentAlreadyExists(int $employeeId, int $companyId): void
    {
        if (
            $this->assignmentRepository->doesEmployeeCompanyAssignmentExist($employeeId, $companyId)
        ) {
            throw new BadRequestException(
                'Employee already assigned to company!'
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
}