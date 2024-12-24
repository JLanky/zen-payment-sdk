<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Functional\Enum;

enum ResponseBodyEnum: string
{
    case CreateTransaction = 'CreateTransactionResponse';
    case TransactionId = '497f6eca-6276-4993-bfeb-53cbbbba6f08';
    case MerchantTransactionId = 'string';
    case Amount = '123.04';
    case CurrencyPln = 'PLN';
    case StatusAccepted = 'ACCEPTED';
    case TypeTrtRefund = 'TRT_REFUND';
    case PaymentChannel = 'PCL_CARD';
}
