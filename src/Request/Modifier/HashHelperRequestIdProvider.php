<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Modifier;

use JLanky\ZenPayments\Helper\HashHelper;

final class HashHelperRequestIdProvider implements RequestIdProviderInterface
{
    public function __construct(
        private readonly HashHelper $hashHelper
    ) {
    }

    public function next(): string
    {
        return $this->hashHelper->generateRequestId();
    }
}
