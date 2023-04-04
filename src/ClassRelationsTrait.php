<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\RelationMetadataInterface;

/**
 * @template Subject of object
 */
trait ClassRelationsTrait
{
    /** @var list<RelationMetadataInterface<Subject>> */
    private array $relations = [];

    /**
     * @return iterable<RelationMetadataInterface<Subject>>
     */
    public function getRelations(): iterable
    {
        return new \ArrayIterator($this->relations);
    }

    /**
     * @return RelationMetadataInterface<Subject>
     */
    public function getRelation(string $name): RelationMetadataInterface
    {
        if (!isset($this->relations[$name])) {
            throw new \OutOfBoundsException(strtr('There is no relation named %relation%', ['%relation%' => $name]));
        }

        return $this->relations[$name];
    }

    /**
     * @param RelationMetadataInterface<Subject> ...$relations
     *
     * @return ClassTypeMetadataInterface<Subject>
     */
    public function addRelations(RelationMetadataInterface ...$relations): ClassTypeMetadataInterface
    {
        foreach ($relations as $relation) {
            $this->relations[$relation->getName()] = $relation;
        }

        return $this;
    }
}
