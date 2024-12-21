<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Modifier;

use Psr\Http\Message\RequestInterface;

interface RequestModifierInterface
{
    public function getHeaderName(): string;

    public function getHeaderValue(): string;

    public function applyRequestModifier(RequestInterface $request): RequestInterface;
}
