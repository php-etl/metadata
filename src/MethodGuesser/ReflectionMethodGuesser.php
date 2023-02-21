<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\MethodGuesser;

use Kiboko\Component\Metadata\ArgumentListMetadata;
use Kiboko\Component\Metadata\ArgumentMetadata;
use Kiboko\Component\Metadata\MethodMetadata;
use Kiboko\Component\Metadata\VariadicArgumentMetadata;
use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\MethodGuesserInterface;
use Kiboko\Contract\Metadata\TypeGuesser\TypeGuesserInterface;

final readonly class ReflectionMethodGuesser implements MethodGuesserInterface
{
    public function __construct(private TypeGuesserInterface $typeGuesser)
    {
    }

    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator
    {
        yield from array_map(
            fn (\ReflectionMethod $method) => new MethodMetadata(
                $method->getName(),
                new ArgumentListMetadata(...array_map(function (\ReflectionParameter $parameter) use ($classOrObject) {
                    if ($parameter->isVariadic()) {
                        return new VariadicArgumentMetadata(
                            $parameter->getName(),
                            ($this->typeGuesser)($classOrObject, $parameter)
                        );
                    }

                    return new ArgumentMetadata(
                        $parameter->getName(),
                        ($this->typeGuesser)($classOrObject, $parameter)
                    );
                }, $method->getParameters())),
                ($this->typeGuesser)($classOrObject, $method)
            ),
            $classOrObject->getMethods(\ReflectionMethod::IS_PUBLIC)
        );
    }
}
