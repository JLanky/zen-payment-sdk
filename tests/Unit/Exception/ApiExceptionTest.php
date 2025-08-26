<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Unit\Exception;

use JLanky\ZenPayments\Exception\ClientApiException;
use JLanky\ZenPayments\Exception\ServerApiException;
use PHPUnit\Framework\TestCase;

class ApiExceptionTest extends TestCase
{
    public function testClientApiExceptionWithCustomMessage(): void
    {
        $responseData = ['errorMessage' => 'Custom error message'];
        $exception = new ClientApiException(400, $responseData);

        $this->assertEquals(400, $exception->getStatusCode());
        $this->assertEquals($responseData, $exception->getResponseData());
        $this->assertEquals('Custom error message', $exception->getMessage());
        $this->assertEquals('Custom error message', $exception->getErrorMessage());
    }

    public function testClientApiExceptionWithDefaultMessage(): void
    {
        $exception = new ClientApiException(404, []);

        $this->assertEquals(404, $exception->getStatusCode());
        $this->assertEquals('Resource not found. The requested endpoint or resource does not exist.', $exception->getMessage());
    }

    public function testClientApiException422WithDefaultMessage(): void
    {
        $exception = new ClientApiException(422, []);

        $this->assertEquals(422, $exception->getStatusCode());
        $this->assertEquals('Invalid request data provided', $exception->getMessage());
    }

    public function testServerApiExceptionWithCustomMessage(): void
    {
        $responseData = ['errorMessage' => 'Server is down'];
        $exception = new ServerApiException(500, $responseData);

        $this->assertEquals(500, $exception->getStatusCode());
        $this->assertEquals($responseData, $exception->getResponseData());
        $this->assertEquals('Server is down', $exception->getMessage());
        $this->assertEquals('Server is down', $exception->getErrorMessage());
    }

    public function testServerApiExceptionWithDefaultMessage(): void
    {
        $exception = new ServerApiException(503, []);

        $this->assertEquals(503, $exception->getStatusCode());
        $this->assertEquals('Service unavailable. The service is temporarily unavailable.', $exception->getMessage());
    }

    public function testExceptionWithErrorCode(): void
    {
        $responseData = [
            'errorCode' => 'VALIDATION_ERROR',
            'errorMessage' => 'Validation failed'
        ];
        $exception = new ClientApiException(400, $responseData);

        $this->assertEquals('VALIDATION_ERROR', $exception->getErrorCode());
        $this->assertEquals('Validation failed', $exception->getErrorMessage());
    }
}
