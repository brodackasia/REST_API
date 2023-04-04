<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    #[Route('/company/{companyId}', name: 'get_company', methods: 'GET')]
    public function getCompany(int $companyId): JsonResponse
    {
        return new JsonResponse(
            $this->companyService->getCompany($companyId)
        );
    }

    #[Route('/companies', name: 'get_companies', methods: 'GET')]
    public function getCompanies(): JsonResponse
    {
        return new JsonResponse(
            $this->companyService->getCompanies()
        );
    }
}
