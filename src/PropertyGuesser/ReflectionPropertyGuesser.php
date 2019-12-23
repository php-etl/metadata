<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\PropertyGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\MixedTypeMetadata;
use Kiboko\Component\ETL\Metadata\PropertyMetadata;
use Kiboko\Component\ETL\Metadata\TypeGuesser\TypeGuesserInterface;
use Kiboko\Component\ETL\Metadata\UnionTypeMetadata;
use Kiboko\Component\ETL\Metadata\VoidTypeMetadata;

final class ReflectionPropertyGuesser implements PropertyGuesserInterface
{
    /** @var TypeGuesserInterface */
    private $typeGuesser;

    public function __construct(TypeGuesserInterface $typeGuesser)
    {
        $this->typeGuesser = $typeGuesser;
    }

    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadata $class): \Iterator
    {
        yield from array_map(
            function(\ReflectionProperty $property) use($classOrObject) {
                return new PropertyMetadata($property->getName(), ($this->typeGuesser)($classOrObject, $property));
            },
            $classOrObject->getProperties(\ReflectionProperty::IS_PUBLIC)
        );
    }
}