<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Purchase\GetTransaction;

use Exception;
use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Modifier\AbstractRequestModifier;
use JLanky\ZenPayments\Modifier\BearerTokenRequestModifier;
use JLanky\ZenPayments\Modifier\ContentTypeJsonRequestModifier;
use JLanky\ZenPayments\Modifier\RequestIdRequestModifier;
use JLanky\ZenPayments\Request\AbstractRequestFactory;
use JLanky\ZenPayments\Request\RequestDataInterface;

class GetTransactionRequestFactory extends AbstractRequestFactory
{
    public function __construct(
        private readonly AbstractEnvironment          $environment,
        PsrDependenciesInterface                      $psrDependencies,
        private readonly PrimaryDependenciesInterface $primaryDependencies,
    ) {
        parent::__construct($psrDependencies, $primaryDependencies, $environment);
    }

    public const METHOD = 'GET';
    public const PATH   = 'transactions/%s';

    /**@param GetTransactionRequestData $requestData */
    protected function getPath(RequestDataInterface $requestData): string
    {
        return sprintf(static::PATH, $requestData->getTransactionId());
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
