<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Response;

use Psr\Http\Message\ResponseInterface;
use RuntimeException;

abstract class AbstractResponseFactory
{
    protected abstract function createResponse(ResponseInterface $response): ResponseDataInterface;

    protected function handleResponse(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();

        if ($statusCode >= 400 && $statusCode < 500) {
            throw new RuntimeException(sprintf(
                'Client error [%d]: %s',
                $statusCode,
                $response->getBody()->getContents()
            ));
        }

        if ($statusCode >= 500 && $statusCode < 600) {
            throw new RuntimeException(sprintf(
                'Server error [%d]: %s',
                $statusCode,
                $response->getBody()->getContents()
            ));
        }

        $body = $response->getBody()->getContents();
        $decodedBody = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
        }

        return $decodedBody;
    }
}
