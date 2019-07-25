<?php

namespace Kiboko\Component\ETL\Metadata;

final class ArgumentMetadata
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