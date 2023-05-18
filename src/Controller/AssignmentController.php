<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AssignmentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssignmentController extends AbstractController
{
    private AssignmentService $assignmentService;

    public function __construct(AssignmentService $assignmentService)
    {
        $this->assignmentService = $assignmentService;
    }

    #[Route('/assign/{employeeId}/{companyId}', name: 'assign', methods: 'POST')]
    public function assignEmployee(int $employeeId, int $companyId): JsonResponse
    {
        try {
            $this->assignmentService->assignEmployeeToCompany($employeeId, $companyId);
        } catch (BadRequestException $exception) {
            return new JsonResponse(
                ['message' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(
            status: Response::HTTP_CREATED
        );
    }

    #[Route('/assign/delete/{employeeId}/{companyId}', name: 'delete_assign', methods: 'DELETE')]
    public function deleteEmployeeCompanyAssignment(int $employeeId, int $companyId): JsonResponse
    {
        try {
            $this->assignmentService->deleteEmployeeCompanyAssignment($employeeId, $companyId);
        } catch (BadRequestException $exception) {
            return new JsonResponse(
                ['message' => $exception->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }
}