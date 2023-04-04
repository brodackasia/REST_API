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

    function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    #[Route('/company/{companyId}', name: 'company', methods: 'GET')]
    public function getCompany(int $companyId): JsonResponse
    {
        return new JsonResponse(
            $this->companyService->getCompany($companyId)
        );
    }

    #[Route('/companies', name: 'all_companies', methods: 'GET')]
    public function getAllCompanies(): JsonResponse
    {
        return new JsonResponse(
            $this->companyService->getAllCompanies()
        );
    }
}
