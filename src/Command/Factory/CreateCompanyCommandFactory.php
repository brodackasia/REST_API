<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\Command\CompanyCommand;

class CompanyCommandFactory
{
    public static function createCommandFromRequestData(array $companyData): CompanyCommand
    {
        return new CompanyCommand(
            $companyData['name'],
            $companyData['vat_identification_number'],
            $companyData['address'],
            $companyData['city'],
            $companyData['zip_code']
        );
    }
}
