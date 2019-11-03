<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class MethodMetadata
{
    /** @var string */
    public $name;
    /** @var ArgumentMetadataList*/
    public $argumentList;
    /** @var TypeMetadataInterface[] */
    public $returnTypes;

    public function __construct(string $name, ArgumentMetadataList $argumentList, TypeMetadataInterface ...$returnTypes)
    {
        $this->name = $name;
        $this->argumentList = $argumentList;
        $this->returnTypes = $returnTypes;
    }
}