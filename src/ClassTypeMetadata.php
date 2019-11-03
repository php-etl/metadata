<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ClassTypeMetadata implements ClassMetadataInterface
{
    /** @var string|null */
    public $namespace;
    /** @var string|null */
    public $name;
    /** @var PropertyMetadata[] */
    public $properties;
    /** @var MethodMetadata[] */
    public $methods;
    /** @var FieldDefinition[] */
    public $fields;
    /** @var RelationDefinitionInterface[] */
    public $relations;

    public function __construct(?string $name, ?string $namespace = null)
    {
        if ($name !== null && strpos($name, '\\') !== false) {
            throw new \RuntimeException('Class names should not contain root namespace anchoring backslash or namespace.');
        }
        if ($namespace !== null && strpos($namespace, '\\') === 0) {
            throw new \RuntimeException('Namespace should not contain root namespace anchoring backslash.');
        }

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

    public function fields(FieldDefinitionInterface ...$fields): self
    {
        foreach ($fields as $field) {
            $this->fields[$field->name] = $field;
        }

        return $this;
    }

    public function relations(RelationDefinitionInterface ...$relations): self
    {
        foreach ($relations as $relation) {
            $this->relations[$relation->name] = $relation;
        }

        return $this;
    }

    public function __toString()
    {
        return ($this->namespace !== null ? $this->namespace . '\\' : '') . $this->name;
    }
}