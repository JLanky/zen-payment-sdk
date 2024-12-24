<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Dependency;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

interface PsrDependenciesInterface
{
    public function getRequestFactory(): RequestFactoryInterface;

    public function getStreamFactory(): StreamFactoryInterface;
    public function getClient(): ClientInterface;
}
