<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\Factory\CreateCompanyCommandFactory;
use App\Command\Factory\UpdateCompanyCommandFactory;
use App\Service\CompanyService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
            $this->companyService->getCompany($companyId),
        );
    }

    #[Route('/companies', name: 'get_companies', methods: 'GET')]
    public function getCompanies(): JsonResponse
    {
        return new JsonResponse(
            $this->companyService->getCompanies(),
        );
    }

    #[Route('/company', name: 'create_company', methods: 'POST')]
    public function createCompany(Request $request): JsonResponse
    {

        return new JsonResponse(
            [
                'companyId' => $this->companyService->createCompany(
                    CreateCompanyCommandFactory::createFromRequest(
                        json_decode($request->getContent(), true)
                    )
                )
            ],
            Response::HTTP_CREATED
        );
    }

    #[Route('/company/{companyId}', name: 'update_company', methods: 'PUT')]
    public function updateCompany(Request $request): JsonResponse
    {
        $this->companyService->updateCompany(
            UpdateCompanyCommandFactory::createFromRequest(
                json_decode($request->getContent(), true)
            )->setCompanyId(
                $request->get('companyId')
            )
        );

        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }

    #[Route('/company/{companyId}', name: 'delete_company', methods: 'DELETE')]
    public function deleteCompany(int $companyId): JsonResponse
    {
        $this->companyService->deleteCompany($companyId);
        
        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }
}
