<?php

namespace Kiboko\Component\ETL\Metadata;

class ArrayEntryMetadata
{
    /** @var string */
    public $name;
    /** @var TypeMetadata[]*/
    public $types;

    public function __construct(string $name, TypeMetadata ...$type)
    {
        $this->name = $name;
        $this->types = $type;
    }
}