<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\Command\CreateCompanyCommand;

class CreateCompanyCommandFactory
{
    public static function createFromRequest(array $companyData): CreateCompanyCommand
    {
        return new CreateCompanyCommand(
            $companyData['name'],
            $companyData['vat_identification_number'],
            $companyData['address'],
            $companyData['city'],
            $companyData['zip_code']
        );
    }
}
