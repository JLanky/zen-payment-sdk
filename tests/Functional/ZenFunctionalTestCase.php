<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Functional;

use JLanky\ZenPayments\Config\Credentials\ZenCredentials;
use JLanky\ZenPayments\Config\Environment\SandboxEnvironment;
use JLanky\ZenPayments\Dependency\Factories\SerializerFactory;
use JLanky\ZenPayments\Dependency\Factories\ValidatorFactory;
use JLanky\ZenPayments\Dependency\PrimaryDependencies;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependencies;
use JLanky\ZenPayments\Helper\HashHelper;
use JLanky\ZenPayments\Service\PayoutService;
use JLanky\ZenPayments\Service\PurchaseService;
use JLanky\ZenPayments\Service\RefundService;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

class ZenFunctionalTestCase extends TestCase
{
    private function getPrimaryDependencies(): PrimaryDependenciesInterface
    {
        return new PrimaryDependencies(new ValidatorFactory(), new SerializerFactory(), new HashHelper());
    }

    protected function getPurchaseService(string $bodyName): PurchaseService
    {
        return new PurchaseService(
            new SandboxEnvironment(
                new ZenCredentials('ipnSecret', 'terminalApiKey')
            ),
            new PsrDependencies(
                new Psr17Factory(),
                new Psr17Factory(),
                $this->getClient($bodyName)
            ),
            $this->getPrimaryDependencies(),
        );
    }

    protected function getPayoutService(string $bodyName): PayoutService
    {
        return new PayoutService(
            new SandboxEnvironment(
                new ZenCredentials('ipnSecret', 'terminalApiKey')
            ),
            new PsrDependencies(
                new Psr17Factory(),
                new Psr17Factory(),
                $this->getClient($bodyName)
            ),
            $this->getPrimaryDependencies(),
        );
    }

    protected function getRefundService(string $bodyName): RefundService
    {
        return new RefundService(
            new SandboxEnvironment(
                new ZenCredentials('ipnSecret', 'terminalApiKey')
            ),
            new PsrDependencies(
                new Psr17Factory(),
                new Psr17Factory(),
                $this->getClient($bodyName)
            ),
            $this->getPrimaryDependencies(),
        );
    }

    protected function getPayoutService(string $bodyName): PayoutService
    {
        return new PayoutService(
            new Sandbox(
                new ZenCredentials('ipnSecret', 'terminalApiKey')
            ),
            new PsrDependencies(
                new Psr17Factory(),
                new Psr17Factory(),
                $this->getClient($bodyName)
            ),
            $this->getPrimaryDependencies(),
        );
    }

    protected function getRefundService(string $bodyName): RefundService
    {
        return new RefundService(
            new Sandbox(
                new ZenCredentials('ipnSecret', 'terminalApiKey')
            ),
            new PsrDependencies(
                new Psr17Factory(),
                new Psr17Factory(),
                $this->getClient($bodyName)
            ),
            $this->getPrimaryDependencies(),
        );
    }

    private function getClient(string $bodyName): ClientInterface
    {
        $client = $this->getMockBuilder(ClientInterface::class)->getMock();
        $client->method('sendRequest')->willReturnCallback(static function () use ($bodyName) {
            return (new FunctionalTestResponseFactory($bodyName))->createResponse();
        });

        return $client;
    }
}
