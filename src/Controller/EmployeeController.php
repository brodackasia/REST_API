<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\EmployeeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    #[Route('/get/employee', name:'get_employee', methods: 'GET')]
    public function getEmployee(Request $request): JsonResponse
    {
        $employeeId = (int) $request->query->get('id');

        return new JsonResponse(
            $this->employeeService->getEmployee($employeeId)
        );
    }

}
