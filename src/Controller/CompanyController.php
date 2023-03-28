<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    public CompanyService $companyService;

    function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    #[Route('get/company/')]
    public function getCompany(): Response
    {
        return new Response('git');
    }
}