<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\Command\UpdateCompanyCommand;

class UpdateCompanyCommandFactory
{
    public static function createFromRequest(array $companyData): UpdateCompanyCommand
    {
        return (new UpdateCompanyCommand())
            ->setName($companyData['name'])
            ->setVatIdentificationNumber($companyData['vatIdentificationNumber'])
            ->setAddress($companyData['address'])
            ->setCity($companyData['city'])
            ->setZipCode($companyData['zipCode']);
    }
}
