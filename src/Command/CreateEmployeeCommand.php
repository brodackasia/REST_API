<?php

declare(strict_types=1);

namespace App\Command;

class CreateEmployeeCommand
{
    public function __construct(
        private readonly string $name,
        private readonly string $surname,
        private readonly string $email,
        private readonly ?string $phone_number
    ) {
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

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }
}
