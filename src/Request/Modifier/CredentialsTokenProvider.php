<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Modifier;

use JLanky\ZenPayments\Config\Environment\AbstractEnvironment;

final class CredentialsTokenProvider implements TokenProviderInterface
{
    public function __construct(
        private readonly AbstractEnvironment $environment
    ) {
    }

    public function get(): string
    {
        return $this->environment
            ->getCredentials()
            ->getTerminalApiKey();
    }
}
