<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\EmployeeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    #[Route('/employee/{employeeId}', name:'employee', methods: 'GET')]
    public function getEmployee(int $employeeId): JsonResponse
    {
        return new JsonResponse(
            $this->employeeService->getEmployee($employeeId)
        );
    }
}
