<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateEmployeeCommand
{
    #[Assert\Regex(pattern: '/\d/', message: 'Your name cannot contain a number', match: false)]
    #[Assert\NotBlank(message: 'Name should not be blank')]
    #[Assert\Length(
        min: 3,
        max: 30,
        minMessage: 'Your name must be at least 3 characters long',
        maxMessage: 'Your name cannot be longer than 30 characters',
    )]
    private string $name;

    #[Assert\Regex(pattern: '/\d/', message: 'Your surname cannot contain a number', match: false)]
    #[Assert\NotBlank(message: 'Name should not be blank')]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Your surname must be at least 3 characters long',
        maxMessage: 'Your surname cannot be longer than 50 characters',
    )]
    private string $surname;

    #[Assert\Email(message: 'The email is not a valid email')]
    #[Assert\NotBlank(message: 'Name should not be blank')]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Your email must be at least 3 characters long',
        maxMessage: 'Your email cannot be longer than 50 characters',
    )]
    public string  $email;

    #[Assert\Regex(pattern: '/^\d{9}$/', message: 'Phone number format should be in format 123456789', match: true)]
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
