<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

final class IterableUnionTypeMetadata implements IterableTypeMetadataInterface, UnionTypeMetadataInterface
{
    /** @var IterableTypeMetadataInterface[] */
    private $types;

    public function __construct(IterableTypeMetadataInterface ...$types)
    {
        $this->types = $types;
    }

    public function count()
    {
        return count($this->types);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->types);
    }

    public function __toString()
    {
        return implode('|', array_map(function (IterableTypeMetadataInterface $type) {
            return (string) $type;
        }, $this->types));
    }
}
