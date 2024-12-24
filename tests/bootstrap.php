<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv();

$dotenv->loadEnv(__DIR__ . '/../.env');

if (file_exists(__DIR__ . '/../.env.local')) {
    $dotenv->overload(__DIR__ . '/../.env.local');
}
