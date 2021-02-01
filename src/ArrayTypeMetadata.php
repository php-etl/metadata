<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ArrayTypeMetadataInterface;

final class ArrayTypeMetadata implements \IteratorAggregate, ArrayTypeMetadataInterface
{
    /** @var ArrayEntryMetadata[] */
    private iterable $entries;

    public function __construct(ArrayEntryMetadata ...$entries)
    {
        $this->entries = $entries;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->entries);
    }

    public function __toString(): string
    {
        return 'array';
    }
}
