<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Purchase\CreateTransaction;

use Exception;
use JLanky\ZenPayments\Request\AbstractRequestFactory;

class CreateTransactionRequestFactory extends AbstractRequestFactory
{
    public const PATH = 'transactions';

    /** @throws Exception */
    protected function getModifiers(): array
    {
        return $this->getDefaultModifiers();
    }
}
