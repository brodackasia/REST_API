<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\Command\CreateEmployeeCommand;

class CreateEmployeeCommandFactory
{
    public static function createFromRequest(array $employeeData): CreateEmployeeCommand
    {
        return new CreateEmployeeCommand(
            $employeeData['name'],
            $employeeData['surname'],
            $employeeData['email'],
            $employeeData['phone_number'] ?? null,
        );
    }
}
