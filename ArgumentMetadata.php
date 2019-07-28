<?php

namespace Kiboko\Component\ETL\Metadata;

final class ArgumentMetadata
{
    /** @var string */
    public $name;
    /** @var bool */
    public $isVariadic;
    /** @var TypeMetadata[]*/
    public $types;

    public function __construct(string $name, bool $isVariadic = false, TypeMetadata ...$type)
    {
        $this->name = $name;
        $this->isVariadic = $isVariadic;
        $this->types = $type;
    }
}