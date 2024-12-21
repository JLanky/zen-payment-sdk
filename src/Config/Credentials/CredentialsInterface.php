<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Config\Credentials;

interface CredentialsInterface
{
    public function getIpnSecret(): string;
    public function getTerminalApiKey(): string;
}
