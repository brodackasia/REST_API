<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CompanyController extends AbstractController
{
    private CompanyService $companyService;

    function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    #[Route('get/company', name: 'get_company', methods: 'GET')]
    public function getCompany(Request $request): JsonResponse
    {
        $companyId = (int) $request->query->get('id');

        return new JsonResponse(
            $this->companyService->getCompany($companyId)
        );
    }

    #[Route('get/companies', name: 'get_all_companies', methods: 'GET')]
    public function getAllCompanies(): JsonResponse
    {
        return new JsonResponse(
            $this->companyService->getAllCompanies()
        );
    }
}
