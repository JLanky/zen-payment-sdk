<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Tests\Integration;

use Exception;
use JLanky\ZenPayments\Config\Credentials\ZenCredentials;
use JLanky\ZenPayments\Config\Environment\Sandbox;
use JLanky\ZenPayments\Dependency\PrimaryDependencies;
use JLanky\ZenPayments\Dependency\PrimaryDependenciesInterface;
use JLanky\ZenPayments\Dependency\PsrDependencies;
use JLanky\ZenPayments\Dependency\PsrDependenciesInterface;
use JLanky\ZenPayments\Helper\HashHelper;
use JLanky\ZenPayments\Service\PurchaseService;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpClient\Psr18Client;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validation;

class ZenIntegrationTestCase extends TestCase
{
    protected ContainerInterface $container;

    /** @throws Exception */
    protected function setUp(): void
    {
        $container = new ContainerBuilder();

        $container->register(RequestFactoryInterface::class, Psr17Factory::class);
        $container->register(StreamFactoryInterface::class, Psr17Factory::class);
        $container->register(ClientInterface::class, Psr18Client::class);

        $container->register(PsrDependenciesInterface::class, PsrDependencies::class)
            ->addArgument(new Reference(RequestFactoryInterface::class))
            ->addArgument(new Reference(StreamFactoryInterface::class))
            ->addArgument(new Reference(ClientInterface::class));

        $primaryDependencies = $this->getPrimaryDependencies();
        $container->set(PrimaryDependenciesInterface::class, $primaryDependencies);

        $container->register(ZenCredentials::class, ZenCredentials::class)
            ->addArgument($_ENV['IPN_SECRET'])
            ->addArgument($_ENV['TERMINAL_API_KEY']);

        $container->register(Sandbox::class, Sandbox::class)
            ->addArgument(new Reference(ZenCredentials::class));

        $container->register(PurchaseService::class, PurchaseService::class)
            ->addArgument(new Reference(Sandbox::class))
            ->addArgument(new Reference(PsrDependenciesInterface::class))
            ->addArgument(new Reference(PrimaryDependenciesInterface::class));

        $this->container = $container;
    }

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
}
