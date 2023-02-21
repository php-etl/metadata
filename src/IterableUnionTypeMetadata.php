<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\IterableTypeMetadataInterface;
use Kiboko\Contract\Metadata\UnionTypeMetadataInterface;

final class IterableUnionTypeMetadata implements IterableTypeMetadataInterface, UnionTypeMetadataInterface, \Stringable
{
    /** @var IterableTypeMetadataInterface[] */
    private readonly iterable $types;

    public function __construct(IterableTypeMetadataInterface ...$types)
    {
        $this->types = $types;
    }

    public function count(): int
    {
        return \count($this->types);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->types);
    }

    public function __toString(): string
    {
        return implode('|', array_map(fn (IterableTypeMetadataInterface $type) => (string) $type, $this->types));
    }
}
