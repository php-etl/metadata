<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class CompositeUnionTypeMetadata implements CompositeTypeMetadataInterface, UnionTypeMetadataInterface
{
    /** @var CompositeTypeMetadataInterface[] */
    private $types;

    public function __construct(CompositeTypeMetadataInterface ...$types)
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
        return implode('|', array_map(function(CompositeTypeMetadataInterface $type) {
            return (string) $type;
        }, $this->types));
    }
}