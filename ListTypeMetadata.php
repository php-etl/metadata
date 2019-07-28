<?php

namespace Kiboko\Component\ETL\Metadata;

final class ListTypeMetadata implements IterableTypeMetadata
{
    /** @var TypeMetadata */
    public $inner;

    public function __construct(TypeMetadata $inner)
    {
        $this->inner = $inner;
    }
}