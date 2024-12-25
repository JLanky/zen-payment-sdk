<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Payout\CreateTransaction;

use Exception;
use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Modifier\AbstractRequestModifier;
use JLanky\ZenPayments\Modifier\BearerTokenRequestModifier;
use JLanky\ZenPayments\Modifier\ContentTypeJsonRequestModifier;
use JLanky\ZenPayments\Modifier\RequestIdRequestModifier;
use JLanky\ZenPayments\Request\AbstractRequestFactory;

class CreatePayoutTransactionRequestFactory extends AbstractRequestFactory
{
    public const PATH = 'payouts';

    public function __construct(
        private readonly AbstractEnvironment          $environment,
        PsrDependenciesInterface                      $psrDependencies,
        private readonly PrimaryDependenciesInterface $primaryDependencies,
    ) {
        parent::__construct($psrDependencies, $primaryDependencies, $environment);
    }

    /**
     * @return AbstractRequestModifier[]
     * @throws Exception
     */
    protected function getModifiers(): array
    {
        $requestId = $this->primaryDependencies
            ->getHashHelper()
            ->generateRequestId();

        $token = $this->environment
            ->getCredentials()
            ->getTerminalApiKey();

        return [
            new ContentTypeJsonRequestModifier(),
            new RequestIdRequestModifier($requestId),
            new BearerTokenRequestModifier($token)
        ];
    }
}
