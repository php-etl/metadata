<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\AnnotatedInterface;
use Kiboko\Contract\Metadata\ClassMetadataInterface;
use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\CollectionTypeMetadataInterface;
use Kiboko\Contract\Metadata\FieldMetadataInterface;
use Kiboko\Contract\Metadata\MethodMetadataInterface;
use Kiboko\Contract\Metadata\PropertyMetadataInterface;
use Kiboko\Contract\Metadata\RelationMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

/**
 * @template Subject of object
 *
 * @implements CollectionTypeMetadataInterface<Subject>
 */
final class CollectionTypeMetadata implements CollectionTypeMetadataInterface, AnnotatedInterface, \Stringable
{
    use AnnotatedTrait;

    /**
     * @param CollectionTypeMetadataInterface<Subject> $decorated
     */
    public function __construct(private readonly CollectionTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->annotation = $annotation;
    }

    /**
     * @return ClassMetadataInterface<Subject>
     */
    public function getType(): ClassMetadataInterface
    {
        return $this->decorated->getType();
    }

    public function getInner(): TypeMetadataInterface
    {
        return $this->decorated->getInner();
    }

    public function getNamespace(): ?string
    {
        return $this->decorated->getNamespace();
    }

    public function getName(): ?string
    {
        return $this->decorated->getName();
    }

    public function getProperties(): iterable
    {
        return $this->decorated->getProperties();
    }

    public function getProperty(string $name): PropertyMetadataInterface
    {
        return $this->decorated->getProperty($name);
    }

    public function addProperties(PropertyMetadataInterface ...$properties): ClassTypeMetadataInterface
    {
        return $this->decorated->addProperties(...$properties);
    }

    public function getMethods(): iterable
    {
        return $this->decorated->getMethods();
    }

    public function getMethod(string $name): MethodMetadataInterface
    {
        return $this->decorated->getMethod($name);
    }

    public function addMethods(MethodMetadataInterface ...$methods): ClassTypeMetadataInterface
    {
        return $this->decorated->addMethods(...$methods);
    }

    public function getFields(): iterable
    {
        return $this->decorated->getFields();
    }

    public function getField(string $name): FieldMetadataInterface
    {
        return $this->decorated->getField($name);
    }

    public function addFields(FieldMetadataInterface ...$fields): ClassTypeMetadataInterface
    {
        return $this->decorated->addFields(...$fields);
    }

    public function getRelations(): iterable
    {
        return $this->decorated->getRelations();
    }

    public function getRelation(string $name): RelationMetadataInterface
    {
        return $this->decorated->getRelation($name);
    }

    public function addRelations(RelationMetadataInterface ...$relations): ClassTypeMetadataInterface
    {
        return $this->decorated->addRelations(...$relations);
    }

    public function __toString(): string
    {
        return (string) $this->decorated;
    }
}
