<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateEmployeeCommand
{
    public function __construct(
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
        public string $name,

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
        public string $surname,

        #[Assert\Length(
            min: 3,
            max: 50,
            minMessage: 'Email must be at least 3 characters long',
            maxMessage: 'Email cannot be longer than 50 characters',
        )]
        #[Assert\Email(message: 'Email is not in valid format')]
        #[Assert\NotBlank(message: 'Email should not be blank')]
        public string  $email,

        //^początek stringa, $ jego koniec, \d to 0-9 i {9} czyli 9 razy
        #[Assert\Regex(
            pattern: '/^\d{9}$/',
            message: 'Phone number should be in format 123456789',
            match: true
        )]
        public ?string $phone_number,
    ) {
    }
}
