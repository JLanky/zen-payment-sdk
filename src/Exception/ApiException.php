<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Exception;

use RuntimeException;

abstract class ApiException extends RuntimeException
{
    protected int $statusCode;
    protected array $responseData;

    public function __construct(
        string $message,
        int $statusCode,
        array $responseData = [],
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;
        $this->responseData = $responseData;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getResponseData(): array
    {
        return $this->responseData;
    }

    public function getErrorCode(): ?string
    {
        return $this->responseData['errorCode'] ?? null;
    }

    public function getErrorMessage(): ?string
    {
        return $this->responseData['errorMessage'] ?? null;
    }
}
