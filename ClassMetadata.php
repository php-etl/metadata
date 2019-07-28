<?php

namespace Kiboko\Component\ETL\Metadata;

final class ClassMetadata implements TypeMetadata
{
    /** @var string */
    public $namespace;
    /** @var string */
    public $name;
    /** @var PropertyMetadata[] */
    public $properties;
    /** @var MethodMetadata[] */
    public $methods;

    public function __construct(string $name, ?string $namespace = null)
    {
        $this->name = $name;
        $this->namespace = $namespace;
        $this->properties = [];
        $this->methods = [];
    }

    public function properties(PropertyMetadata ...$properties): self
    {
        foreach ($properties as $property) {
            $this->properties[$property->name] = $property;
        }

        return $this;
    }

    public function methods(MethodMetadata ...$methods): self
    {
        foreach ($methods as $method) {
            $this->methods[$method->name] = $method;
        }

        return $this;
    }

    public function __toString()
    {
        return ($this->namespace !== null ? $this->namespace . '\\' : '') . $this->name;
    }
}