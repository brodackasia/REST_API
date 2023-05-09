<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateEmployeeCommand
{
    public function __construct(

        #[Assert\Regex(pattern: '/\d/', message: 'Your name cannot contain a number', match: false)]
        #[Assert\NotBlank(message: 'Name should not be null')]
        public string $name,

        #[Assert\Regex(pattern: '/\d/', message: 'Your surname cannot contain a number', match: false)]
        #[Assert\NotBlank(message: 'Surname should not be null')]
        public string $surname,

        #[Assert\NotBlank(message: 'Email should not be null')]
        #[Assert\Email(message: 'This email is not in valid format')]
        public string  $email,

        #[Assert\Type(type: 'numeric', message: 'This phone number is not in valid format')]
        public ?string $phone_number,
    ) {
    }
}
