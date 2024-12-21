<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Config\Environment;

class Sandbox extends BaseEnvironment implements UrlInterface
{
    public const URL = 'https://api.zen-test.com/v1/';
}
