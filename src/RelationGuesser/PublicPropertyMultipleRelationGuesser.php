<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\RelationGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\CollectionTypeMetadata;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\MultipleRelationMetadata;
use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;

final class PublicPropertyMultipleRelationGuesser implements RelationGuesserInterface
{
    public function __invoke(ClassTypeMetadata $class): \Iterator
    {
        foreach ($class->getProperties() as $property) {
            $types = iterator_to_array($this->filterTypes(...$property->getTypes()));
            if (count($types) <= 0) {
                continue;
            }

            yield new MultipleRelationMetadata(
                $property->getName(),
                ...$types
            );
        }
    }

    private function filterTypes(TypeMetadataInterface ...$types): \Generator
    {
        foreach ($types as $type) {
            if (!$type instanceof ListTypeMetadata &&
                !$type instanceof CollectionTypeMetadata
            ) {
                continue;
            }

            yield $type;
        }
    }
}