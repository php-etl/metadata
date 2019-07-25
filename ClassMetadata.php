<?php

namespace Kiboko\Component\ETL\Metadata;

final class ClassMetadata
{
    /** @var string */
    public $namespace;
    /** @var string */
    public $name;
    /** @var PropertyMetadata[] */
    public $properties;
    /** @var MethodMetadata[] */
    public $methods;
    /** @var AttributeMetadata[] */
    public $attributes;
    /** @var RelationshipMetadata[] */
    public $relationships;

    public function __construct(string $name, ?string $namespace = null)
    {
        $this->name = $name;
        $this->namespace = $namespace;
        $this->properties = [];
        $this->methods = [];
    }

    public function __toString()
    {
        return ($this->namespace !== null ? $this->namespace . '\\' : '') . $this->name;
    }
}