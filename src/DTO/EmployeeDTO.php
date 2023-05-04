<?php

declare(strict_types=1);

namespace App\DTO;

use JsonSerializable;

class EmployeeDTO implements JsonSerializable
{
    public function __construct(
        private readonly int $employeeId,
        private readonly string $name,
        private readonly string $surname,
        private readonly string $email,
        private readonly string $phoneNumber,
        private readonly array $companiesIds
    ) {
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getCompaniesIds(): array
    {
        return $this->companiesIds;
    }

    public function jsonSerialize(): array
    {
        return [
            'employeeId' => $this->getEmployeeId(),
            'employeeName' => $this->getName(),
            'employeeSurname' => $this->getSurname(),
            'employeeEmail' => $this->getEmail(),
            'employeePhoneNumber' => $this->getPhoneNumber(),
            'companiesIds' => $this->getCompaniesIds(),
        ];
    }
}
