<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\RelationGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Component\Metadata\CompositeUnionTypeMetadata;
use Kiboko\Component\Metadata\IncompatibleTypeException;
use Kiboko\Component\Metadata\TypeMetadataInterface;
use Kiboko\Component\Metadata\UnaryRelationMetadata;
use Kiboko\Component\Metadata\UnionTypeMetadataInterface;

final class PublicPropertyUnaryRelationGuesser implements RelationGuesserInterface
{
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        foreach ($class->getProperties() as $property) {
            try {
                yield new UnaryRelationMetadata(
                    $property->getName(),
                    $this->filterTypes($property->getType())
                );
            } catch (IncompatibleTypeException $e) {
                continue;
            }
        }
    }

    private function filterTypes(TypeMetadataInterface $type): CompositeTypeMetadataInterface
    {
        if (!$type instanceof UnionTypeMetadataInterface) {
            if (!$type instanceof CompositeTypeMetadataInterface) {
                throw new IncompatibleTypeException(strtr(
                    'Expected to have at least one composite type, got none compatible: %actual%.',
                    [
                        '%actual%' => (string) $type,
                    ]
                ));
            }

            return $type;
        }

        $filtered = [];
        foreach ($type as $inner) {
            if (!$type instanceof CompositeTypeMetadataInterface) {
                continue;
            }

            $filtered[] = $inner;
        }

        if (count($filtered) <= 0) {
            throw new IncompatibleTypeException(strtr(
                'Expected to have at least one composite type, got none compatible: %actual%.',
                [
                    '%actual%' => implode(', ', array_map(function(TypeMetadataInterface $inner) {
                        return (string) $inner;
                    }, iterator_to_array($type))),
                ]
            ));
        }

        if (count($filtered) > 1) {
            return new CompositeUnionTypeMetadata(...$filtered);
        }

        return reset($filtered);
    }
}
