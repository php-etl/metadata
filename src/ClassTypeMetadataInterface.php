<?php

namespace Kiboko\Component\ETL\Metadata;

interface ClassTypeMetadataInterface extends ClassMetadataInterface
{
    public function getNamespace(): ?string;

    public function getName(): ?string;

    /**
     * @return iterable<PropertyMetadataInterface>|PropertyMetadataInterface[]
     */
    public function getProperties(): iterable;

    public function getProperty(string $name): PropertyMetadataInterface;

    public function addProperties(PropertyMetadataInterface ...$properties): ClassTypeMetadataInterface;

    /**
     * @return iterable<MethodMetadataInterface>|MethodMetadataInterface[]
     */
    public function getMethods(): iterable;

    public function getMethod(string $name): MethodMetadataInterface;

    public function addMethods(MethodMetadataInterface ...$methods): ClassTypeMetadataInterface;

    /**
     * @return iterable<FieldMetadataInterface>|FieldMetadataInterface[]
     */
    public function getFields(): iterable;

    public function getField(string $name): FieldMetadataInterface;

    public function addFields(FieldMetadataInterface ...$fields): ClassTypeMetadataInterface;

    /**
     * @return iterable<RelationMetadataInterface>|RelationMetadataInterface[]
     */
    public function getRelations(): iterable;

    public function getRelation(string $name): RelationMetadataInterface;

    public function addRelations(RelationMetadataInterface ...$relations): ClassTypeMetadataInterface;
}