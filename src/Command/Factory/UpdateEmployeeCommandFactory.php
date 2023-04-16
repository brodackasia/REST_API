<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\Command\UpdateEmployeeCommand;

class UpdateEmployeeCommandFactory
{
    public static function createFromArray(array $employeeData): UpdateEmployeeCommand
    {
        return (new UpdateEmployeeCommand())
            ->setName($employeeData['name'])
            ->setSurname($employeeData['surname'])
            ->setEmail($employeeData['email'])
            ->setPhoneNumber($employeeData['phone_number']);
    }
}
