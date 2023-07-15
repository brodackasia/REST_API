<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\Factory\CreateEmployeeCommandFactory;
use App\Command\Factory\UpdateEmployeeCommandFactory;
use App\Service\EmployeeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    public function __construct(
        public readonly EmployeeService $employeeService
    ) {}

    #[Route('/employee/{employeeId}', name: 'get_employee', methods: 'GET')]
    public function getEmployee(int $employeeId): JsonResponse
    {
        try {
            $this->employeeService->getEmployee($employeeId);
        } catch (BadRequestException $exception) {
            return $this->badRequestResponse($exception);
        }

        return new JsonResponse(
            $this->employeeService->getEmployee($employeeId)
        );
    }

    #[Route('/employees', name: 'get_employees', methods: 'GET')]
    public function getEmployees(): JsonResponse
    {
        return new JsonResponse(
            $this->employeeService->getEmployees()
        );
    }

    #[Route('/employee', name: 'create_employee', methods: 'POST')]
    public function createEmployee(Request $request): JsonResponse
    {
        try {
            $createdEmployeeId = $this->employeeService->createEmployee(
                CreateEmployeeCommandFactory::createFromRequest(
                    json_decode($request->getContent(), true)
                )
            );
        } catch (BadRequestException $exception) {
            return $this->badRequestResponse($exception);
        }

        return new JsonResponse(
            ['employeeId' => $createdEmployeeId],
            Response::HTTP_CREATED
        );
    }

    #[Route('/employee/{employeeId}', name: 'update_employee', methods: 'PUT')]
    public function updateEmployee(Request $request): JsonResponse
    {
        try {
            $this->employeeService->updateEmployee(
                UpdateEmployeeCommandFactory::createFromArray(
                    json_decode($request->getContent(), true)
                )->setEmployeeId(
                    (int) $request->get('employeeId')
                )
            );
        } catch (BadRequestException $exception) {
            return $this->badRequestResponse($exception);
        }

        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }

    #[Route('/employee/{employeeId}', name: 'delete_employee', methods: 'DELETE')]
    public function deleteEmployee(int $employeeId): JsonResponse
    {
        try {
            $this->employeeService->deleteEmployee($employeeId);
        } catch (BadRequestException $exception) {
            return $this->badRequestResponse($exception);
        }

        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }

    private function badRequestResponse(BadRequestException $exception): JsonResponse
    {
        return new JsonResponse(
            ['message' => $exception->getMessage()],
            Response::HTTP_BAD_REQUEST
        );
    }
}
