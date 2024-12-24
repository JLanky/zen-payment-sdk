<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Dependency;

use JLanky\ZenPayments\Helper\HashHelper;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface PrimaryDependenciesInterface
{
    public function getValidator(): ValidatorInterface;
    public function getSerializer(): SerializerInterface;
    public function getHashHelper(): HashHelper;
}
