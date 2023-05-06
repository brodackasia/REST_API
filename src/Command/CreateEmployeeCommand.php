<?php

declare(strict_types=1);

namespace App\Command;

readonly class CreateEmployeeCommand
{
    public function __construct(
        public string  $name,
        public string  $surname,
        public string  $email,
        public ?string $phone_number,
    ) {
    }
}
