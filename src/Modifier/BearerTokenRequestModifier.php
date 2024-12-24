<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Modifier;

use JLanky\ZenPayments\Modifier\RequestModifierInterface;
use Psr\Http\Message\RequestInterface;

class BearerTokenRequestModifier extends AbstractRequestModifier implements RequestModifierInterface
{
    private const HEADER_NAME  = 'Authorization';

    public function __construct(private readonly string $headerValue)
    {
    }

    public function getHeaderName(): string
    {
        return self::HEADER_NAME;
    }

    public function getHeaderValue(): string
    {
        return sprintf('Bearer %s', $this->headerValue);
    }
}
