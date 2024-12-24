<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Dependency;

use JLanky\ZenPayments\Helper\HashHelper;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PrimaryDependencies implements PrimaryDependenciesInterface
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly SerializerInterface $serializer,
        private readonly HashHelper $hashHelper,
    ) {
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    public function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    public function getHashHelper(): HashHelper
    {
        return $this->hashHelper;
    }
}
