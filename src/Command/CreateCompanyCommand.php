<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateCompanyCommand
{
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Company name must be at least 2 characters long!',
        maxMessage: 'Company name cannot be longer than 50 characters!',
    )]
    #[Assert\NotBlank(message: 'Company name must not be blank!')]
    public string $name;

    #[Assert\Regex(
        pattern: '/^\d{10}$/',
        message: 'Company vat identification number must contain 10 digits!',
        match: true
    )]
    #[Assert\NotBlank(message: 'Company vat identification number must not be blank!')]
    public string $vatIdentificationNumber;

    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'Company address must be at least 5 characters long!',
        maxMessage: 'Company address cannot be longer than 30 characters!',
    )]
    #[Assert\NotBlank(message: 'Company address must not be blank!')]
    public string $address;

    #[Assert\Length(
        min: 2,
        max: 30,
        minMessage: 'Company city must be at least 2 characters long!',
        maxMessage: 'Company city cannot be longer than 30 characters!',
    )]
    #[Assert\Regex(
        pattern: '/\d/',
        message: 'Company city cannot contain a number',
        match: false
    )]
    #[Assert\NotBlank(message: 'Company city must not be blank!')]
    public string $city;

    #[Assert\Regex(
        pattern: '/^\d{2}-\d{3}$/',
        message: 'Company zip code must be in format 12-345!',
        match: true
    )]
    #[Assert\NotBlank(message: 'Company zip code must not be blank!')]
    public string $zipCode;

    public function __construct(
        string $name,
        string $vatIdentificationNumber,
        string $address,
        string $city,
        string $zipCode,
    ) {
        $this->name = $name;
        $this->vatIdentificationNumber = $vatIdentificationNumber;
        $this->address = $address;
        $this->city = $city;
        $this->zipCode = $zipCode;
    }
}
