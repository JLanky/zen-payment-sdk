<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Enum;

enum SourceChannel: string
{
    case WEB = 'WEB';
    case MOBILE = 'MOBILE';
    case API = 'API';
    case TEST_CHANNEL = 'TEST_CHANNEL';

    public static function getChoices(): array
    {
        return array_column(self::cases(), 'value');
    }
}
