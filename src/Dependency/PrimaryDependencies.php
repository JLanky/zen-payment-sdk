<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Dependency;

use JLanky\ZenPayments\Dependency\Factories\SerializerFactory;
use JLanky\ZenPayments\Dependency\Factories\ValidatorFactory;
use JLanky\ZenPayments\Helper\HashHelper;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PrimaryDependencies implements PrimaryDependenciesInterface
{
    public function __construct(
        private readonly ValidatorFactory $validatorFactory,
        private readonly SerializerFactory $serializerFactory,
        private readonly HashHelper $hashHelper,
    ) {
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->validatorFactory->create();
    }

    public function getSerializer(): SerializerInterface
    {
        return $this->serializerFactory->create();
    }

    public function getHashHelper(): HashHelper
    {
        return $this->hashHelper;
    }
}
