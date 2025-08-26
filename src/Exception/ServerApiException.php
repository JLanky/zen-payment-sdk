<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Exception;

class ServerApiException extends ApiException
{
    public function __construct(
        int $statusCode,
        array $responseData = [],
        ?\Throwable $previous = null
    ) {
        $errorMessage = $this->getServerErrorMessage($statusCode, $responseData);
        
        parent::__construct($errorMessage, $statusCode, $responseData, $previous);
    }

    private function getServerErrorMessage(int $statusCode, array $responseData): string
    {
        $apiErrorMessage = $responseData['errorMessage'] ?? null;
        
        return match ($statusCode) {
            500 => $apiErrorMessage ?? 'Internal server error. Please try again later.',
            502 => $apiErrorMessage ?? 'Bad gateway. The server received an invalid response.',
            503 => $apiErrorMessage ?? 'Service unavailable. The service is temporarily unavailable.',
            504 => $apiErrorMessage ?? 'Gateway timeout. The request timed out.',
            default => $apiErrorMessage ?? sprintf('Server error occurred with status code %d', $statusCode)
        };
    }
}
