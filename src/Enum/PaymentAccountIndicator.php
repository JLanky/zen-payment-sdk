<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Enum;

enum PaymentAccountIndicator: string
{
    case NO_ACCOUNT = '01';
    case GUEST_CHECKOUT = '02';
    case CREATED_DURING_TRANSACTION = '03';
    case LESS_THAN_30_DAYS = '04';
    case MORE_THAN_30_DAYS = '05';

    public static function getChoices(): array
    {
        return array_column(self::cases(), 'value');
    }
}
