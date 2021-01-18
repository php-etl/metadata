<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\PropertyGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\Metadata\PropertyMetadata;
use Kiboko\Component\Metadata\TypeGuesser\TypeGuesserInterface;

final class ReflectionPropertyGuesser implements PropertyGuesserInterface
{
    /** @var TypeGuesserInterface */
    private $typeGuesser;

    public function __construct(TypeGuesserInterface $typeGuesser)
    {
        $this->typeGuesser = $typeGuesser;
    }

    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator
    {
        yield from array_map(
            function(\ReflectionProperty $property) use($classOrObject) {
                return new PropertyMetadata($property->getName(), ($this->typeGuesser)($classOrObject, $property));
            },
            $classOrObject->getProperties(\ReflectionProperty::IS_PUBLIC)
        );
    }
}
