<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Enum;

enum PasswordChangeIndicator: string
{
    case CHANGED_DURING_TRANSACTION = '01';
    case LESS_THAN_30_DAYS = '02';
    case BETWEEN_30_AND_60_DAYS = '03';
    case MORE_THAN_60_DAYS = '04';

    public static function getChoices(): array
    {
        return array_column(self::cases(), 'value');
    }
}
