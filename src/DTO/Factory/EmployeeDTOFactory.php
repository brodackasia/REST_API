<?php

declare(strict_types=1);

namespace App\DTO\Factory;

use App\DTO\EmployeeDTO;

class EmployeeDTOFactory
{
    public static function createFromArray(array $employeeData): EmployeeDTO
    {
        return new EmployeeDTO(
            $employeeData['id'],
            $employeeData['name'],
            $employeeData['surname'],
            $employeeData['email'],
            $employeeData['phone_number'] ?? null,
            EmployeeDTOFactory::convertCompaniesIds(
                $employeeData['companies_ids']
            ),
        );
    }

    public static function convertCompaniesIds(string $companiesIdsInString): array
    {
        return empty($companiesIdsInString) ? [] : array_map(
            'intval',
            explode(
                ',',
                $companiesIdsInString,
            )
        );
    }

    public static function createCollectionFromArray(array $employeeData): array
    {
        $result = [];

        foreach ($employeeData as $collectionArray) {
            $result[] = EmployeeDTOFactory::createFromArray($collectionArray);
        }

        return $result;
    }
}
