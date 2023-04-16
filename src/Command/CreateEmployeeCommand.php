<?php

declare(strict_types=1);

namespace App\Command;

class CreateEmployeeCommand
{
    private string $name;

    private string $surname;

    private string $email;

    private string $phoneNumber;

    public function __construct(
        string $name,
        string $surname,
        string $email,
        string $phone_number
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phoneNumber = $phone_number;
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
}
