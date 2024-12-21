<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Modifier;

class RequestIdRequestModifier extends AbstractRequestModifier implements RequestModifierInterface
{

    private const HEADER_NAME  = 'request-id';

    public function __construct(private readonly string $requestId)
    {
    }

    public function getHeaderName(): string
    {
        return self::HEADER_NAME;
    }

    public function getHeaderValue(): string
    {
        return $this->requestId;
    }
}
