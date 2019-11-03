<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

class MultipleRelationDefinition implements RelationDefinitionInterface
{
    /** @var string */
    public $name;
    /** @var TypeMetadataInterface[] */
    public $types;

    public function __construct(
        string $name,
        IterableTypeMetadataInterface ...$types
    ) {
        $this->name = $name;
        $this->types = $types;
    }
}