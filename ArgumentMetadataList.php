<?php

namespace Kiboko\Component\ETL\Metadata;

class ArgumentMetadataList
{
    /** @var ArgumentMetadata[] */
    public $arguments;

    public function __construct(ArgumentMetadata ...$arguments)
    {
        $this->arguments = $arguments;
    }
}