<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Refund;

use Exception;
use JLanky\ZenPayments\Request\AbstractRequestFactory;

class CreateRefundTransactionRequestFactory extends AbstractRequestFactory
{
    public const PATH = 'transactions/refund';

    /** @throws Exception */
    protected function getModifiers(): array
    {
        return $this->getDefaultModifiers();
    }
}
