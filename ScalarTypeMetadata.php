<?php

namespace Kiboko\Component\ETL\Metadata;

final class ScalarTypeMetadata implements TypeMetadata
{
    /** @var string */
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }
}