<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Functional;

use JLanky\ZenPayments\Config\Credentials\ZenCredentials;
use JLanky\ZenPayments\Config\Environment\Sandbox;
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
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validation;

class ZenFunctionalTestCase extends TestCase
{
    private function getPrimaryDependencies(): PrimaryDependenciesInterface
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();

        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());

        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        $serializer = new Serializer(
            [
                new ObjectNormalizer(
                    $classMetadataFactory,
                    $metadataAwareNameConverter,
                    null,
                    new ReflectionExtractor()
                ),
                new ArrayDenormalizer(),
            ],
            [new JsonEncoder(),]
        );

        return new PrimaryDependencies($validator, $serializer, new HashHelper());
    }

    protected function getPurchaseService(string $bodyName): PurchaseService
    {
        return new PurchaseService(
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
