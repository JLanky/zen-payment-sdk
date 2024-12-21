<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Config\Credentials;

class ZenCredentials implements CredentialsInterface
{
    public function __construct(
        private readonly string $ipnSecret,
        private readonly string $terminalApiKey
    ) {
    }

    public function getIpnSecret(): string
    {
        return $this->ipnSecret;
    }

    public function getTerminalApiKey(): string
    {
        return $this->terminalApiKey;
    }
}
