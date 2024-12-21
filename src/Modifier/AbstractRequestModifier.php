<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Modifier;

use Psr\Http\Message\RequestInterface;

abstract class AbstractRequestModifier implements RequestModifierInterface
{
    public function applyRequestModifier(RequestInterface $request): RequestInterface
    {
        return $request->withHeader(
            $this->getHeaderName(),
            $this->getHeaderValue()
        );
    }
}
