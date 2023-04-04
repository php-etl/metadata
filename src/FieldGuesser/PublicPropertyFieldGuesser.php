<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\FieldGuesser;

use Kiboko\Component\Metadata\ArrayTypeMetadata;
use Kiboko\Component\Metadata\FieldMetadata;
use Kiboko\Component\Metadata\IncompatibleTypeException;
use Kiboko\Component\Metadata\MixedTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\UnionTypeMetadata;
use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\FieldGuesserInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;
use Kiboko\Contract\Metadata\UnionTypeMetadataInterface;

final class PublicPropertyFieldGuesser implements FieldGuesserInterface
{
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        foreach ($class->getProperties() as $property) {
            try {
                yield new FieldMetadata(
                    $property->getName(),
                    $this->filterTypes($property->getType())
                );
            } catch (IncompatibleTypeException) {
                continue;
            }
        }
    }

    private function filterTypes(TypeMetadataInterface $type): TypeMetadataInterface
    {
        if (!$type instanceof UnionTypeMetadataInterface) {
            if (!$type instanceof ScalarTypeMetadata && !$type instanceof ArrayTypeMetadata) {
                throw new IncompatibleTypeException(strtr('Expected to have at least one scalar or array type, got none compatible: %actual%.', ['%actual%' => (string) $type]));
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

        if (\count($filtered) <= 0) {
            throw new IncompatibleTypeException(strtr('Expected to have at least one scalar or array type, got none compatible: %actual%.', ['%actual%' => implode(', ', array_map(fn (TypeMetadataInterface $inner) => (string) $inner, iterator_to_array($type)))]));
        }

        if (\count($filtered) > 1) {
            return new UnionTypeMetadata(...$filtered);
        }

        $type = reset($filtered);
        if (false !== $type) {
            return $type;
        }

        return new MixedTypeMetadata();
    }
}
