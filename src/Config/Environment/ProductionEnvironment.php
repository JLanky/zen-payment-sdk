<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Config\Environment;

class ProductionEnvironment extends AbstractEnvironment implements UrlInterface
{
    public const URL = 'https://api.zen.com/v1/';
}
