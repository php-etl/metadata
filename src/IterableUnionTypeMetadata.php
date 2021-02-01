<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\IterableTypeMetadataInterface;
use Kiboko\Contract\Metadata\UnionTypeMetadataInterface;

final class IterableUnionTypeMetadata implements IterableTypeMetadataInterface, UnionTypeMetadataInterface
{
    /** @var IterableTypeMetadataInterface[] */
    private iterable $types;

    public function __construct(IterableTypeMetadataInterface ...$types)
    {
        $this->types = $types;
    }

    public function count(): int
    {
        return count($this->types);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->types);
    }

    public function __toString(): string
    {
        return implode('|', array_map(function (IterableTypeMetadataInterface $type) {
            return (string) $type;
        }, $this->types));
    }
}
