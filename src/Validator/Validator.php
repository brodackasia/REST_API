<?php

declare(strict_types=1);

namespace App\Validator;

use Exception;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(object $objectToValidate): ?string
    {
        $violationList = $this->validator->validate($objectToValidate);

        if (count($violationList) > 0) {
            throw new BadRequestException(
                $violationList[0]->getMessageTemplate()
            );
        }

        return null;
    }
}
