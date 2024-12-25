<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Dependency\Factories;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorFactory
{
    public function create(): ValidatorInterface
    {
        return Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();
    }
}
