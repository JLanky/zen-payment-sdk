<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Payout\CreateTransaction;

use Exception;
use JLanky\ZenPayments\Request\AbstractRequestFactory;

class CreatePayoutTransactionRequestFactory extends AbstractRequestFactory
{
    public const PATH = 'payouts';

    /** @throws Exception */
    protected function getModifiers(): array
    {
        return $this->getDefaultModifiers();
    }
}
