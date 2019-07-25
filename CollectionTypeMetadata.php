<?php

namespace Kiboko\Component\ETL\Metadata;

final class CollectionTypeMetadata implements CompositeTypeMetadata
{
    /** @var ClassTypeMetadata */
    public $type;
    /** @var TypeMetadata */
    public $inner;

    public function __construct(ClassTypeMetadata $type, TypeMetadata $inner)
    {
        $this->type = $type;
        $this->inner = $inner;
    }
}