<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\AssignmentRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AssignmentService
{
    private AssignmentRepository $assignmentRepository;

    private EmployeeService $employeeService;

    private CompanyService $companyService;

    public function __construct(
        AssignmentRepository $assignmentRepository,
        EmployeeService $employeeService,
        CompanyService $companyService,
    ) {
        $this->assignmentRepository = $assignmentRepository;
        $this->employeeService = $employeeService;
        $this->companyService = $companyService;
    }
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
}