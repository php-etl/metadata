<?php

namespace Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\Guesser;
use Phpactor\Docblock\DocblockFactory;

class ClassMetadataBuilder
{
    public function buildFromFQCN(string $className): ClassTypeMetadata
    {
        try {
            return $this->build(new \ReflectionClass($className));
        } catch (\ReflectionException $e) {
            throw new \RuntimeException(
                strtr(
                    'The class %class.name% was not declared. It does either not exist or is does not have been auto-loaded.',
                    [
                        '%class.name%' => $className,
                    ]
                ),
                null,
                $e
            );
        }
    }

    public function buildFromObject(object $object): ClassTypeMetadata
    {
        return $this->build(new \ReflectionObject($object));
    }

    public function build(\Reflector $classOrObject): ClassTypeMetadata
    {
        if (!$classOrObject instanceof \ReflectionClass &&
            !$classOrObject instanceof \ReflectionObject
        ) {
            throw new \InvalidArgumentException('Expected object of type \\ReflectionClass or \\ReflectionObject.');
        }

        try {
            $fqcn = $classOrObject->getName();
            if (($index = strrpos($fqcn, '\\')) === false) {
                $object = new ClassTypeMetadata($fqcn);
            } else {
                $object = new ClassTypeMetadata(
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

            $object->properties(...array_map(
                function(\ReflectionProperty $property) use($classOrObject, $typeGuesser) {
                    return new PropertyMetadata(
                        $property->getName(),
                        ...$typeGuesser($classOrObject, $property)
                    );
                },
                $classOrObject->getProperties(\ReflectionProperty::IS_PUBLIC)
            ));

            $object->methods(...array_map(
                function(\ReflectionMethod $method) use($classOrObject, $typeGuesser) {
                    return new MethodMetadata(
                        $method->getName(),
                        new ArgumentMetadataList(...array_map(function(\ReflectionParameter $parameter) use($typeGuesser, $classOrObject) {
                            return new ArgumentMetadata(
                                $parameter->getName(),
                                $parameter->isVariadic(),
                                ...$typeGuesser($classOrObject, $parameter)
                            );
                        }, $method->getParameters())),
                        ...$typeGuesser($classOrObject, $method)
                    );
                },
                $classOrObject->getMethods(\ReflectionMethod::IS_PUBLIC)
            ));
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