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

    private string $companyId;

    public function __construct(
        int $employeeId,
        string $name,
        string $surname,
        string $email,
        string $phoneNumber,
        string $companyId
    ) {
        $this->employeeId = $employeeId;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->companyId = $companyId;
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

    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    public function jsonSerialize(): array
    {
        return [
            'employeeId' => $this->getEmployeeId(),
            'employeeName' => $this->getName(),
            'employeeSurname' => $this->getSurname(),
            'employeeEmail' => $this->getEmail(),
            'employeePhoneNumber' => $this->getPhoneNumber(),
            'companyId' => $this->getCompanyId(),
        ];
    }
}
