<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Exception;

use JLanky\ZenPayments\Enum\ValidationErrorMessages;

class ClientApiException extends ApiException
{
    public function __construct(
        int $statusCode,
        array $responseData = [],
        ?\Throwable $previous = null
    ) {
        $errorMessage = $this->getClientErrorMessage($statusCode, $responseData);
        
        parent::__construct($errorMessage, $statusCode, $responseData, $previous);
    }

    private function getClientErrorMessage(int $statusCode, array $responseData): string
    {
        $apiErrorMessage = $responseData['errorMessage'] ?? null;
        
        return match ($statusCode) {
            400 => $apiErrorMessage ?? ValidationErrorMessages::INVALID_REQUEST_DATA,
            401 => $apiErrorMessage ?? 'Authentication failed. Please check your credentials.',
            403 => $apiErrorMessage ?? 'Access denied. You do not have permission to perform this action.',
            404 => $apiErrorMessage ?? 'Resource not found. The requested endpoint or resource does not exist.',
            409 => $apiErrorMessage ?? 'Conflict. The request conflicts with the current state of the resource.',
            422 => $apiErrorMessage ?? ValidationErrorMessages::INVALID_REQUEST_DATA,
            429 => $apiErrorMessage ?? 'Too many requests. Please try again later.',
            default => $apiErrorMessage ?? sprintf('Client error occurred with status code %d', $statusCode)
        };
    }
}
