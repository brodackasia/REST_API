<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\Factory\CreateEmployeeCommandFactory;
use App\Command\Factory\UpdateEmployeeCommandFactory;
use App\Service\EmployeeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    #[Route('/employee/{employeeId}', name:'get_employee', methods: 'GET')]
    public function getEmployee(int $employeeId): JsonResponse
    {
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
        return new JsonResponse(
            [
                'employeeId' => $this->employeeService->createEmployee(
                    CreateEmployeeCommandFactory::createFromRequest(
                        json_decode($request->getContent(), true)
                    )
                )
            ],
            Response::HTTP_CREATED
        );
    }

    #[Route('/employee/{employeeId}', name: 'update_employee', methods: 'PUT')]
    public function updateEmployee(Request $request): JsonResponse
    {
        return new JsonResponse(
            ($this->employeeService->updateEmployee(
                UpdateEmployeeCommandFactory::createFromArray(
                    json_decode($request->getContent(), true)
                )->setEmployeeId(
                    $request->get('employeeId')
                )
            )) ? 204 : 404
        );
    }

    #[Route('/employee/{employeeId}', name: 'delete_employee', methods: 'DELETE')]
    public function deleteEmployee(int $employeeId): JsonResponse
    {
        $this->employeeService->deleteEmployee($employeeId);

        return new JsonResponse(
            Response::HTTP_NO_CONTENT
        );
    }

    #[Route('/assign/{employeeId}/{companyId}', name: 'assign', methods: 'POST')]
    public function assignEmployee(int $employeeId, int $companyId): JsonResponse
    {
        $this->employeeService->assignEmployeeToCompany($employeeId, $companyId);

        return new JsonResponse(
            Response::HTTP_NO_CONTENT
        );
    }
}
