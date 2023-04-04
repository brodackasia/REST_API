<?php

declare(strict_types=1);

namespace App\DTO\Factory;

use App\DTO\EmployeeDTO;

class EmployeeDTOFactory
{
    public static function createFromArray(array $data): EmployeeDTO
    {
        return new EmployeeDTO(
            $data['id'],
            $data['name'],
            $data['surname'],
            $data['email'],
            $data['phone_number']
        );
    }
}
