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
            ->setVatIdentificationNumber($companyData['vat_identification_number'])
            ->setAddress($companyData['address'])
            ->setCity($companyData['city'])
            ->setZipCode($companyData['zip_code']);
    }
}
