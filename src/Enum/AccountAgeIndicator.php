<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Enum;

enum AccountAgeIndicator: string
{
    case LESS_THAN_30_DAYS = '01';
    case BETWEEN_30_AND_60_DAYS = '02';
    case BETWEEN_60_AND_90_DAYS = '03';
    case BETWEEN_90_AND_180_DAYS = '04';
    case MORE_THAN_180_DAYS = '05';

    public static function getChoices(): array
    {
        return array_column(self::cases(), 'value');
    }
}
