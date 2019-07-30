<?php

declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ArrayEntryMetadata
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