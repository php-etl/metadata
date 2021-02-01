<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\TypeMetadataInterface;
use Kiboko\Contract\Metadata\UnionTypeMetadataInterface;

final class UnionTypeMetadata implements UnionTypeMetadataInterface
{
    /** @var TypeMetadataInterface[] */
    private iterable $types;

    public function __construct(TypeMetadataInterface ...$types)
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
        return implode('|', array_map(function (TypeMetadataInterface $type) {
            return (string) $type;
        }, $this->types));
    }
}
