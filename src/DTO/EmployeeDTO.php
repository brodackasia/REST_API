<?php

declare(strict_types=1);

namespace App\DTO;

use JsonSerializable;

readonly class EmployeeDTO implements JsonSerializable
{
    public function __construct(
        public int $employeeId,
        public string $name,
        public string $surname,
        public string $email,
        public ?string $phoneNumber,
        public array $companiesIds,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'employeeId' => $this->employeeId,
            'employeeName' => $this->name,
            'employeeSurname' => $this->surname,
            'employeeEmail' => $this->email,
            'employeePhoneNumber' => $this->phoneNumber,
            'companiesIds' => $this->companiesIds,
        ];
    }
}
