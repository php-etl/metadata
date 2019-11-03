<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ArrayTypeMetadata implements \IteratorAggregate, CompositeTypeMetadataInterface
{
    /** @var ArrayEntryMetadata[] */
    public $entries;

    public function __construct(ArrayEntryMetadata ...$entries)
    {
        $this->entries = $entries;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->entries);
    }

    public function __toString()
    {
        return 'array';
    }
}