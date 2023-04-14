<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\Factory\EmployeeCommandFactory;
use App\DTO\Factory\EmployeeDTOFactory;
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
                    EmployeeCommandFactory::createFromRequest(
                        $request->request->all()
                    )
                )
            ],
            Response::HTTP_CREATED
        );
    }
}
