<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class Validator
{
    public function __construct(
        public ValidatorInterface $validator
    ) {}

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
