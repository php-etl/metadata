<?php

namespace Kiboko\Component\ETL\Metadata;

final class ArrayTypeMetadata implements CompositeTypeMetadata
{
    /** @var ArrayEntryMetadata[] */
    public $entries;

    public function __construct(ArrayEntryMetadata ...$entries)
    {
        $this->entries = $entries;
    }
}