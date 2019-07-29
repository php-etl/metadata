<?php

namespace Kiboko\Component\ETL\Metadata;

final class VariadicArgumentMetadata implements ArgumentMetadataInterface
{
    /** @var string */
    public $name;
    /** @var TypeMetadataInterface[] */
    public $types;

    public function __construct(string $name, TypeMetadataInterface ...$type)
    {
        $this->name = $name;
        $this->types = $type;
    }
}