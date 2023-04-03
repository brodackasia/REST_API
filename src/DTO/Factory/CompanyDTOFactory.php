<?php

declare(strict_types=1);

namespace App\DTO\Factory;

use App\DTO\CompanyDTO;

class CompanyDTOFactory
{
    public static function createFromArray(array $data): CompanyDTO
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

    public static function createCollectionFromArray(array $data): array
    {
        $result = [];
        foreach ($data as $collectionArray) {
            $result[] = CompanyDTOFactory::createFromArray($collectionArray);
        }
        return $result;
    }
}
