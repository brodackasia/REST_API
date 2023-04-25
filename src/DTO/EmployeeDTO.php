<?php

declare(strict_types=1);

namespace App\DTO;

use JsonSerializable;

class EmployeeDTO implements JsonSerializable
{
    private int $employeeId;

    private string $name;

    private string $surname;

    private string $email;

    private string $phoneNumber;

    private array $companiesIds;

    public function __construct(
        int $employeeId,
        string $name,
        string $surname,
        string $email,
        string $phoneNumber,
        array $companiesIds
    ) {
        $this->employeeId = $employeeId;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->companiesIds = $companiesIds;
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
