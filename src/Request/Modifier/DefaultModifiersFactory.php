<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Modifier;

use JLanky\ZenPayments\Modifier\BearerTokenRequestModifier;
use JLanky\ZenPayments\Modifier\ContentTypeJsonRequestModifier;
use JLanky\ZenPayments\Modifier\RequestIdRequestModifier;
use JLanky\ZenPayments\Modifier\RequestModifierInterface;

final class DefaultModifiersFactory
{
    public function __construct(
        private readonly RequestIdProviderInterface $ids,
        private readonly TokenProviderInterface $tokens,
        private readonly ContentTypeJsonRequestModifier $jsonModifier,
    ) {}

    /** @return list<RequestModifierInterface> */
    public function create(): array
    {
        return [
            $this->jsonModifier,
            new RequestIdRequestModifier($this->ids->next()),
            new BearerTokenRequestModifier($this->tokens->get()),
        ];
    }
}
