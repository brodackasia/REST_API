<?php

declare(strict_types=1);

namespace App\Command;

readonly class CreateCompanyCommand
{
    public function __construct(
        public string $name,
        public string $vatIdentificationNumber,
        public string $address,
        public string $city,
        public string $zipCode
    ) {
    }
}
