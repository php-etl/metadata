<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\TypeMetadataInterface;
use Kiboko\Contract\Metadata\UnionTypeMetadataInterface;

/**
 * @implements \IteratorAggregate<TypeMetadataInterface>
 */
final class UnionTypeMetadata implements UnionTypeMetadataInterface, \IteratorAggregate, \Stringable
{
    /** @var list<TypeMetadataInterface> */
    private readonly array $types;

    public function __construct(TypeMetadataInterface ...$types)
    {
        $this->types = array_values($types);
    }

    public function count(): int
    {
        return \count($this->types);
    }

    /**
     * @return \Traversable<TypeMetadataInterface>
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->types);
    }

    public function __toString(): string
    {
        return implode('|', array_map(fn (TypeMetadataInterface $type) => (string) $type, $this->types));
    }
}
