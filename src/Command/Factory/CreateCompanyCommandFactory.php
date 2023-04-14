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
            $companyData['vatIdentificationNumber'],
            $companyData['address'],
            $companyData['city'],
            $companyData['zipCode']
        );
    }
}
