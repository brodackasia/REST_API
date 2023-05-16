<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateEmployeeCommand
{
    #[Assert\Regex(pattern: '/\d/', message: 'Your name cannot contain a number', match: false)]
    #[Assert\NotBlank(message: 'Name should not be blank')]
    #[Assert\Length(
        min: 3,
        max: 30,
        minMessage: 'Your name must be at least 3 characters long',
        maxMessage: 'Your name cannot be longer than 30 characters',
    )]
    public string $name;

    #[Assert\Regex(pattern: '/\d/', message: 'Your surname cannot contain a number', match: false)]
    #[Assert\NotBlank(message: 'Surname should not be blank')]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Your surname must be at least 3 characters long',
        maxMessage: 'Your surname cannot be longer than 50 characters',
    )]
    public string $surname;

    #[Assert\Email(message: 'This email is not in valid format')]
    #[Assert\NotBlank(message: 'Email should not be blank')]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'Your email must be at least 3 characters long',
        maxMessage: 'Your email cannot be longer than 50 characters',
    )]
    public string  $email;

    //^początek stringa, $ jego koniec, \d to 0-9 i {9} czyli 9 razy
    #[Assert\Regex(pattern: '/^\d{9}$/', message: 'Phone number format should be in format 123456789', match: true)]
    public ?string $phone_number;

    public function __construct(
        string $name,
        string $surname,
        string  $email,
        ?string $phone_number,
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }
}
