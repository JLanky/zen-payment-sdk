<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Enum;

final class ValidationChoices
{
    public const PAYMENT_CHANNELS = ['PCL_CARD', 'PCL_BANK', 'PCL_WALLET', 'PCL_CRYPTO'];

    public const SOURCE_CHANNELS = ['WEB', 'MOBILE', 'API', 'TEST_CHANNEL'];

    public const ACCOUNT_AGE_INDICATORS = ['01', '02', '03', '04', '05'];

    public const ACCOUNT_CHANGE_INDICATORS = ['01', '02', '03', '04'];

    public const PASSWORD_CHANGE_INDICATORS = ['01', '02', '03', '04'];

    public const PAYMENT_ACCOUNT_INDICATORS = ['01', '02', '03', '04', '05'];

    public const FEE_OWNERS = ['partner'];

    public const PAYOUT_TYPES = ['bitbaywithdrawal'];
}
