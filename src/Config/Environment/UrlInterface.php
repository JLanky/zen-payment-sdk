<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Config\Environment;

interface UrlInterface
{
    public function getBaseUrl(): string;
}
