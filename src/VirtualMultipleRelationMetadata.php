<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class VirtualMultipleRelationMetadata extends MultipleRelationMetadata
{
    use VirtualMultipleTrait;

    public function __construct(
        string $name,
        ?MethodMetadata $accessor = null,
        ?MethodMetadata $mutator = null,
        ?MethodMetadata $adder = null,
        ?MethodMetadata $remover = null,
        ?MethodMetadata $walker = null,
        ?MethodMetadata $counter = null,
        TypeMetadataInterface ...$types
    ) {
        parent::__construct($name, ...$types);

        $this->accessor = $accessor;
        $this->mutator = $mutator;
        $this->adder = $adder;
        $this->remover = $remover;
        $this->walker = $walker;
        $this->counter = $counter;
    }
}