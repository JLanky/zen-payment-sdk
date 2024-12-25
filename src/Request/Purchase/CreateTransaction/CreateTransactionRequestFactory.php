<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Purchase\CreateTransaction;

use Exception;
use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Modifier\AbstractRequestModifier;
use JLanky\ZenPayments\Modifier\BearerTokenRequestModifier;
use JLanky\ZenPayments\Modifier\ContentTypeJsonRequestModifier;
use JLanky\ZenPayments\Modifier\RequestIdRequestModifier;
use JLanky\ZenPayments\Request\AbstractRequestFactory;

class CreateTransactionRequestFactory extends AbstractRequestFactory
{
    public const PATH = 'transactions';

    /** @throws Exception */
    protected function getModifiers(): array
    {
        return $this->getDefaultModifiers();
    }
}
