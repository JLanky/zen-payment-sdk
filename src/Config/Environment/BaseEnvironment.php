<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Config\Environment;

use JLanky\ZenPayments\Config\Credentials\CredentialsInterface;

abstract class BaseEnvironment implements UrlInterface
{
    public const URL = '';

    public function __construct(private readonly CredentialsInterface $credentials)
    {
    }

    public function getBaseUrl(): string
    {
        return static::URL;
    }

    public function getCredentials(): CredentialsInterface
    {
        return $this->credentials;
    }
}
