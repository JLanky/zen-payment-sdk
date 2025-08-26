<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Enum;

enum FeeOwner: string
{
    case PARTNER = 'partner';

    public static function getChoices(): array
    {
        return array_column(self::cases(), 'value');
    }
}
