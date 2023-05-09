<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateEmployeeCommand
{
    #[Assert\Regex(pattern: '/\d/', message: 'Your name cannot contain a number', match: false)]
    #[Assert\NotBlank(message: 'Name should not be null')]
    private string $name;

    #[Assert\Regex(pattern: '/\d/', message: 'Your surname cannot contain a number', match: false)]
    #[Assert\NotBlank(message: 'Surname should not be null')]
    private string $surname;

    #[Assert\NotBlank(message: 'Email should not be null')]
    #[Assert\Email(message: 'The email is not a valid email')]
    public string  $email;

    #[Assert\Type(type: 'numeric', message: 'The phone number is not a valid number')]
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
