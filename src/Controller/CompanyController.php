<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\Factory\CreateCompanyCommandFactory;
use App\Command\Factory\UpdateCompanyCommandFactory;
use App\Service\CompanyService;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    public function __construct(
        public readonly CompanyService $companyService
    ) {}

    #[Route('/company/{companyId}', name: 'get_company', methods: 'GET')]
    public function getCompany(int $companyId): JsonResponse
    {
        try {
            $companyData = $this->companyService->getCompany($companyId);
        } catch (BadRequestException $exception) {
            return $this->badRequestResponse($exception);
        }

        return new JsonResponse(
            $companyData
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
        try {
            $createdCompanyId = $this->companyService->createCompany(
                CreateCompanyCommandFactory::createFromRequest(
                    json_decode($request->getContent(), true)
                )
            );
        } catch (BadRequestException $exception) {
            return $this->badRequestResponse($exception);
        }

        return new JsonResponse(
            ['companyId' => $createdCompanyId],
            Response::HTTP_CREATED
        );
    }

    #[Route('/company/{companyId}', name: 'update_company', methods: 'PUT')]
    public function updateCompany(Request $request): JsonResponse
    {
        try {
            $this->companyService->updateCompany(
                UpdateCompanyCommandFactory::createFromRequest(
                    json_decode($request->getContent(), true)
                )->setCompanyId(
                    (int) $request->get('companyId')
                )
            );
        } catch (BadRequestException $exception) {
            return $this->badRequestResponse($exception);
        }

        return new JsonResponse(
            status: Response::HTTP_NO_CONTENT
        );
    }

    #[Route('/company/{companyId}', name: 'delete_company', methods: 'DELETE')]
    public function deleteCompany(int $companyId): JsonResponse
    {
        try {
            $this->companyService->deleteCompany($companyId);
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
            status: Response::HTTP_BAD_REQUEST
        );
    }
}
