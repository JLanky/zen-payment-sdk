<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Modifier;

interface TokenProviderInterface
{
    public function get(): string;
}
