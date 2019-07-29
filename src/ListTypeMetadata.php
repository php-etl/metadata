<?php

namespace Kiboko\Component\ETL\Metadata;

final class ListTypeMetadata implements IterableTypeMetadataInterface
{
    /** @var TypeMetadataInterface */
    public $inner;

    public function __construct(TypeMetadataInterface $inner)
    {
        $this->inner = $inner;
    }

    public function __toString()
    {
        return ((string) $this->inner).'[]';
    }
}