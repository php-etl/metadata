<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

class FieldMetadata implements FieldMetadataInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(
        string $name,
        TypeMetadataInterface ...$types
    ) {
        $this->name = $name;
        $this->types = $types;
    }
}