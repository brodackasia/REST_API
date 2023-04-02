<?php

declare(strict_types=1);

namespace App\DTO\Factory;

use App\DTO\CompanyDTO;

class CompanyDTOFactory
{
    public static function createCompanyDTO(array $data): CompanyDTO
    {
        return new CompanyDTO(
            $data['id'],
            $data['name'],
            $data['vat_identification_number'],
            $data['address'],
            $data['city'],
            $data['zip_code']
        );
    }
}
