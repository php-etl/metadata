<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\FieldGuesser;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\FieldMetadata;
use Kiboko\Component\ETL\Metadata\PropertyMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;

final class PublicPropertyFieldGuesser implements FieldGuesserInterface
{
    public function __invoke(ClassTypeMetadata $class): \Iterator
    {
        /** @var PropertyMetadata $property */
        foreach ($class->getProperties() as $property) {
            $types = iterator_to_array($this->filterTypes(...$property->getTypes()));
            if (count($types) <= 0) {
                continue;
            }

            yield new FieldMetadata(
                $property->getName(),
                ...array_values($property->getTypes())
            );
        }
    }

    private function filterTypes(TypeMetadataInterface ...$types): \Generator
    {
        foreach ($types as $type) {
            if (!$type instanceof ScalarTypeMetadata &&
                !$type instanceof ArrayTypeMetadata
            ) {
                continue;
            }

            yield $type;
        }
    }
}