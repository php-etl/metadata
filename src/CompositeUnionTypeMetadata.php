<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Contract\Metadata\UnionTypeMetadataInterface;

final class CompositeUnionTypeMetadata implements CompositeTypeMetadataInterface, UnionTypeMetadataInterface
{
    /** @var CompositeTypeMetadataInterface[] */
    private iterable $types;

    public function __construct(CompositeTypeMetadataInterface ...$types)
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
        return implode('|', array_map(function (CompositeTypeMetadataInterface $type) {
            return (string) $type;
        }, $this->types));
    }
}
