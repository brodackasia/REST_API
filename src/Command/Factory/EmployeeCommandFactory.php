<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\Command\EmployeeCommand;

class EmployeeCommandFactory
{
    public static function createFromRequest(array $employeeData): EmployeeCommand
    {
        return new EmployeeCommand(
            $employeeData['name'],
            $employeeData['surname'],
            $employeeData['email'],
            $employeeData['phone_number'],
        );
    }
}
