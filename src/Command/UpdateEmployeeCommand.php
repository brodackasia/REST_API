<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateEmployeeCommand
{
    #[Assert\Length(
        min: 3,
        max: 30,
        minMessage: 'Name must be at least 3 characters long',
        maxMessage: 'Name cannot be longer than 30 characters',
    )]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Name cannot contain a number',
        match: false
    )]
    #[Assert\NotBlank(message: 'Name should not be blank')]
    private string $name;

    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Surname must be at least 3 characters long',
        maxMessage: 'Surname cannot be longer than 50 characters',
    )]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Surname cannot contain a number',
        match: false
    )]
    #[Assert\NotBlank(message: 'Surname should not be blank')]
    private string $surname;

    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Email must be at least 3 characters long',
        maxMessage: 'Email cannot be longer than 50 characters',
    )]
    #[Assert\Email(message: 'Email is not in valid format')]
    #[Assert\NotBlank(message: 'Email should not be blank')]
    private string  $email;

    //^początek stringa, $ jego koniec, \d to 0-9 i {9} czyli 9 razy
    #[Assert\Regex(
        pattern: '/^\d{9}$/',
        message: 'Phone number should be in format 123456789',
        match: true
    )]
    private ?string $phoneNumber;

    private int $employeeId;

    public function setName(string $name): UpdateEmployeeCommand
    {
        $this->name = $name;
        return $this;
    }

    public function setSurname(string $surname): UpdateEmployeeCommand
    {
        $this->surname = $surname;
        return $this;
    }

    public function setEmail(string $email): UpdateEmployeeCommand
    {
        $this->email = $email;
        return $this;
    }

    public function setPhoneNumber(?string $phoneNumber): UpdateEmployeeCommand
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function setEmployeeId(int $employeeId): UpdateEmployeeCommand
    {
        $this->employeeId = $employeeId;
        return $this;
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
        return $this->phoneNumber;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }
}
