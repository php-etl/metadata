<?php

namespace Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\Guesser;
use Phpactor\Docblock\DocblockFactory;

class ClassMetadataBuilder
{
    public function buildFromFQCN(string $className): ClassMetadata
    {
        return $this->build(new \ReflectionClass($className));
    }

    public function buildFromObject(object $object): ClassMetadata
    {
        return $this->build(new \ReflectionObject($object));
    }

    public function build(\Reflector $classOrObject)
    {
        if (!$classOrObject instanceof \ReflectionClass ||
            !$classOrObject instanceof \ReflectionObject
        ) {
            throw new \InvalidArgumentException('Expected object of type \\ReflectionClass or \\ReflectionObject.');
        }

        try {
            $fqcn = $classOrObject->getName();
            if (($index = strrpos($fqcn, '\\')) === false) {
                $object = new ClassMetadata($fqcn);
            } else {
                $object = new ClassMetadata(
                    substr($fqcn, $index + 1),
                    substr($fqcn, 0, $index)
                );
            }

            $typeGuesser = new Guesser\CompositeTypeGuesser(
                version_compare(PHP_VERSION, '5.4.0') >= 0 ?
                    new Guesser\Native\Php74TypeGuesser() :
                    new Guesser\Native\DummyTypeGuesser(),
                new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
            );
            foreach ($classOrObject->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
                $object->properties[$property->getName()] = new PropertyMetadata(
                    $property->getName(),
                    ...$typeGuesser($classOrObject, $property)
                );
            }

            foreach ($classOrObject->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                $object->methods[$method->getName()] = $methodMetadata = new MethodMetadata(
                    $method->getName(),
                    new ArgumentMetadataList(...array_map(function(\ReflectionParameter $parameter) use($typeGuesser, $classOrObject) {
                        return new ArgumentMetadata(
                            $parameter->getName(),
                            ...$typeGuesser($classOrObject, $parameter)
                        );
                    }, $method->getParameters())),
                    ...$typeGuesser($classOrObject, $method)
                );
            }
        } catch (\ReflectionException $e) {
            throw new \RuntimeException(
                'An error occurred during class metadata building.',
                null,
                $e
            );
        }

        return $object;
    }
}