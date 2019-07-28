<?php

namespace Kiboko\Component\ETL\Metadata;

final class ClassReferenceMetadata implements CompositeTypeMetadata
{
    /** @var string */
    public $namespace;
    /** @var string */
    public $name;

    public function __construct(string $name, ?string $namespace = null)
    {
        $this->name = $name;
        $this->namespace = $namespace;
    }

    public function __toString()
    {
        return ($this->namespace !== null ? $this->namespace . '\\' : '') . $this->name;
    }
}