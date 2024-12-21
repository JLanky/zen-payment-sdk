<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Modifier;

class ContentTypeJsonRequestModifier extends AbstractRequestModifier implements RequestModifierInterface
{
    private const HEADER_NAME  = 'Content-Type';
    private const HEADER_VALUE = 'application/json';

    public function getHeaderName(): string
    {
        return self::HEADER_NAME;
    }

    public function getHeaderValue(): string
    {
        return self::HEADER_VALUE;
    }
}
