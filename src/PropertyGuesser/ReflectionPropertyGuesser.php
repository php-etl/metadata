<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\PropertyGuesser;

use Kiboko\Component\Metadata\PropertyMetadata;
use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\PropertyGuesser\PropertyGuesserInterface;
use Kiboko\Contract\Metadata\TypeGuesser\TypeGuesserInterface;

final class ReflectionPropertyGuesser implements PropertyGuesserInterface
{
    public function __construct(private TypeGuesserInterface $typeGuesser)
    {}

    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator
    {
        yield from array_map(
            function (\ReflectionProperty $property) use ($classOrObject) {
                return new PropertyMetadata($property->getName(), ($this->typeGuesser)($classOrObject, $property));
            },
            $classOrObject->getProperties(\ReflectionProperty::IS_PUBLIC)
        );
    }
}
