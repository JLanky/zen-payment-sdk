<?php

declare(strict_types=1);

namespace JLanky\ZenPayments\Dependency\Factories;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerFactory
{
    public function create(): SerializerInterface
    {
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());

        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        return new Serializer(
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
    }
}
