<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

class FieldDefinition implements FieldDefinitionInterface
{
    /** @var string */
    public $name;
    /** @var TypeMetadataInterface[] */
    public $types;

    public function __construct(
        string $name,
        TypeMetadataInterface ...$types
    ) {
        $this->name = $name;
        $this->types = $types;
    }
}