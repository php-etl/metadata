<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ClassTypeMetadata implements ClassTypeMetadataInterface
{
    private ?string $namespace;
    private ?string $name;
    /** @var PropertyMetadataInterface[] */
    private iterable $properties;
    /** @var MethodMetadataInterface[] */
    private iterable $methods;
    /** @var FieldMetadata[] */
    private iterable $fields;
    /** @var RelationMetadataInterface[] */
    private iterable $relations;

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
        $this->fields = [];
        $this->relations = [];
    }

    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return iterable<PropertyMetadataInterface>|PropertyMetadataInterface[]
     */
    public function getProperties(): iterable
    {
        return new \ArrayIterator($this->properties);
    }

    public function getProperty(string $name): PropertyMetadataInterface
    {
        if (!isset($this->properties[$name])) {
            throw new \OutOfBoundsException(strtr('There is no property named %property%', [
                '%property%' => $name,
            ]));
        }

        return $this->properties[$name];
    }

    public function addProperties(PropertyMetadataInterface ...$properties): self
    {
        foreach ($properties as $property) {
            $this->properties[$property->getName()] = $property;
        }

        return $this;
    }

    /**
     * @return iterable<MethodMetadataInterface>|MethodMetadataInterface[]
     */
    public function getMethods(): iterable
    {
        return new \ArrayIterator($this->methods);
    }

    public function getMethod(string $name): MethodMetadataInterface
    {
        if (!isset($this->methods[$name])) {
            throw new \OutOfBoundsException(strtr('There is no method named %method%', [
                '%method%' => $name,
            ]));
        }

        return $this->methods[$name];
    }

    public function addMethods(MethodMetadataInterface ...$methods): self
    {
        foreach ($methods as $method) {
            $this->methods[$method->getName()] = $method;
        }

        return $this;
    }

    /**
     * @return iterable<FieldMetadataInterface>|FieldMetadataInterface[]
     */
    public function getFields(): iterable
    {
        return new \ArrayIterator($this->fields);
    }

    public function getField(string $name): FieldMetadataInterface
    {
        if (!isset($this->fields[$name])) {
            throw new \OutOfBoundsException(strtr('There is no field named %field%', [
                '%field%' => $name,
            ]));
        }

        return $this->fields[$name];
    }

    public function addFields(FieldMetadataInterface ...$fields): self
    {
        foreach ($fields as $field) {
            $this->fields[$field->getName()] = $field;
        }

        return $this;
    }

    /**
     * @return iterable<RelationMetadataInterface>|RelationMetadataInterface[]
     */
    public function getRelations(): iterable
    {
        return new \ArrayIterator($this->relations);
    }

    public function getRelation(string $name): RelationMetadataInterface
    {
        if (!isset($this->relations[$name])) {
            throw new \OutOfBoundsException(strtr('There is no relation named %relation%', [
                '%relation%' => $name,
            ]));
        }

        return $this->relations[$name];
    }

    public function addRelations(RelationMetadataInterface ...$relations): self
    {
        foreach ($relations as $relation) {
            $this->relations[$relation->getName()] = $relation;
        }

        return $this;
    }

    public function __toString()
    {
        return ($this->namespace !== null ? $this->namespace . '\\' : '') . $this->name;
    }
}