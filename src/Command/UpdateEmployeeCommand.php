<?php

declare(strict_types=1);

namespace App\Command;

class UpdateEmployeeCommand
{
    private string $name;

    private string $surname;

    private string $email;

    private ?string $phoneNumber;

    private string $employeeId;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): UpdateEmployeeCommand
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): UpdateEmployeeCommand
    {
        $this->surname = $surname;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): UpdateEmployeeCommand
    {
        $this->email = $email;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): UpdateEmployeeCommand
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeId;
    }

    public function setEmployeeId(string $employeeId): UpdateEmployeeCommand
    {
        $this->employeeId = $employeeId;
        return $this;
    }
}
