<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Purchase\CreateTransaction;

use JLanky\ZenPayments\Request\RequestDataInterface;
use JLanky\ZenPayments\ValueObject\BaseTransaction;

class CreateTransactionRequestData extends BaseTransaction implements RequestDataInterface
{
}
