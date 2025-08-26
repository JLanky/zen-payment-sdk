<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Enum;

enum PaymentChannel: string
{
    case CARD = 'PCL_CARD';
    case BANK = 'PCL_BANK';
    case WALLET = 'PCL_WALLET';
    case CRYPTO = 'PCL_CRYPTO';

    public static function getChoices(): array
    {
        return array_column(self::cases(), 'value');
    }
}
