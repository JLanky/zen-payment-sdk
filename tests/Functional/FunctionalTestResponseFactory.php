<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Functional;

use JsonException;
use Nyholm\Psr7\Response;

class FunctionalTestResponseFactory
{
    private object $response;

    /** @throws JsonException */
    public function __construct(string $bodyName)
    {
        $bodyString = file_get_contents(sprintf(__DIR__ . '/Bodies/%s.json', $bodyName));

        if (is_string($bodyString) === false) {
            throw new JsonException();
        }

        $this->response = (object) json_decode($bodyString, false, 512, JSON_THROW_ON_ERROR);
    }

    /** @throws JsonException */
    public function createResponse(): Response
    {
        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode($this->response, JSON_THROW_ON_ERROR)
        );
    }
}
