<?php

declare(strict_types=1);

namespace App\DTO\Factory;

use App\DTO\CompanyDTO;

class CompanyDTOFactory
{
    public static function createFromArray(array $companyData): CompanyDTO
    {
        return new CompanyDTO(
            $companyData['id'],
            $companyData['name'],
            $companyData['vat_identification_number'],
            $companyData['address'],
            $companyData['city'],
            $companyData['zip_code'],
            CompanyDTOFactory::convertEmployeesIds(
                $companyData['employees_ids']
            ),
        );
    }

    public static function convertEmployeesIds(string $employeesIdsInString): ?array
    {
        if ($employeesIdsInString === "") {
            return [];
        } else {
            return array_map(
                'intval',
                explode(
                    ',',
                    $employeesIdsInString
                )
            );
        }
    }

    public static function createCollectionFromArray(array $companyData): array
    {
        $result = [];

        foreach ($companyData as $collectionArray) {
            $result[] = CompanyDTOFactory::createFromArray($collectionArray);
        }

        return $result;
    }
}
