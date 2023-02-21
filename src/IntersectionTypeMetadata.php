<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\IntersectionTypeMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class IntersectionTypeMetadata implements IntersectionTypeMetadataInterface, \Stringable
{
    /** @var TypeMetadataInterface[] */
    private readonly iterable $types;

    public function __construct(TypeMetadataInterface ...$types)
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
        return implode('&', array_map(fn (TypeMetadataInterface $type) => (string) $type, $this->types));
    }
}
