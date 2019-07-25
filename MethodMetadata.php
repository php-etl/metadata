<?php

namespace Kiboko\Component\ETL\Metadata;

final class MethodMetadata
{
    /** @var string */
    public $name;
    /** @var ArgumentMetadataList*/
    public $argumentList;
    /** @var TypeMetadata[]*/
    public $returnTypes;

    public function __construct(string $name, ArgumentMetadataList $argumentList, TypeMetadata ...$returnTypes)
    {
        $this->name = $name;
        $this->argumentList = $argumentList;
        $this->returnTypes = $returnTypes;
    }
}