<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\CompanyRepository;

class CompanyService
{
    public CompanyRepository $companyRepository;

    function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getCompany()
    {

    }
}