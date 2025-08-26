<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Modifier;

interface RequestIdProviderInterface
{
    public function next(): string;
}
