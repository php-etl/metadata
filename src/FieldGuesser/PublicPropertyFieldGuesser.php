<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\FieldGuesser;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\FieldMetadata;
use Kiboko\Component\ETL\Metadata\IncompatibleTypeException;
use Kiboko\Component\ETL\Metadata\PropertyMetadataInterface;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\UnionTypeMetadata;
use Kiboko\Component\ETL\Metadata\UnionTypeMetadataInterface;

final class PublicPropertyFieldGuesser implements FieldGuesserInterface
{
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        /** @var PropertyMetadataInterface $property */
        foreach ($class->getProperties() as $property) {
            try {
                yield new FieldMetadata(
                    $property->getName(),
                    $this->filterTypes($property->getType())
                );
            } catch (IncompatibleTypeException $e) {
                continue;
            }
        }
    }

    private function filterTypes(TypeMetadataInterface $type): TypeMetadataInterface
    {
        if (!$type instanceof UnionTypeMetadataInterface) {
            if (!$type instanceof ScalarTypeMetadata && !$type instanceof ArrayTypeMetadata) {
                throw new IncompatibleTypeException(strtr(
                    'Expected to have at least one scalar or array type, got none compatible: %actual%.',
                    [
                        '%actual%' => (string) $type,
                    ]
                ));
            }

            return $type;
        }

        $filtered = [];
        foreach ($type as $inner) {
            if (!$type instanceof ScalarTypeMetadata && !$type instanceof ArrayTypeMetadata) {
                continue;
            }

            $filtered[] = $inner;
        }

        if (count($filtered) <= 0) {
            throw new IncompatibleTypeException(strtr(
                'Expected to have at least one scalar or array type, got none compatible: %actual%.',
                [
                    '%actual%' => implode(', ', array_map(function(TypeMetadataInterface $inner) {
                        return (string) $inner;
                    }, iterator_to_array($type))),
                ]
            ));
        }

        if (count($filtered) > 1) {
            return new UnionTypeMetadata(...$filtered);
        }

        return reset($filtered);
    }
}