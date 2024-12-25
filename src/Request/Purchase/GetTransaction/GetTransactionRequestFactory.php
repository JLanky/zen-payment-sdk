<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Request\Purchase\GetTransaction;

use Exception;
use JLanky\ZenPayments\Request\AbstractRequestFactory;
use JLanky\ZenPayments\Request\RequestDataInterface;

class GetTransactionRequestFactory extends AbstractRequestFactory
{
    public const METHOD = 'GET';
    public const PATH   = 'transactions/%s';

    /** @throws Exception */
    protected function getModifiers(): array
    {
        return $this->getDefaultModifiers();
    }

    /**@param GetTransactionRequestData $requestData */
    protected function getPath(RequestDataInterface $requestData): string
    {
        return sprintf(static::PATH, $requestData->getTransactionId());
    }
}
