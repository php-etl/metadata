<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class UnaryRelationMetadata implements RelationMetadataInterface
{
    /** @var string */
    public $name;
    /** @var TypeMetadataInterface[] */
    public $types;

    public function __construct(
        string $name,
        CompositeTypeMetadataInterface ...$types
    ) {
        $this->name = $name;
        $this->types = $types;
    }
}