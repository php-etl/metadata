<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\IterableTypeMetadataInterface;
use Kiboko\Contract\Metadata\MethodMetadataInterface;

final class VirtualMultipleRelationMetadata extends MultipleRelationMetadata
{
    use VirtualMultipleTrait;

    public function __construct(
        string $name,

        IterableTypeMetadataInterface $type,
        ?MethodMetadataInterface $accessor = null,
        ?MethodMetadataInterface $mutator = null,
        ?MethodMetadataInterface $adder = null,
        ?MethodMetadataInterface $remover = null,
        ?MethodMetadataInterface $walker = null,
        ?MethodMetadataInterface $counter = null
    ) {
        parent::__construct($name, $type);

        $this->accessor = $accessor;
        $this->mutator = $mutator;
        $this->adder = $adder;
        $this->remover = $remover;
        $this->walker = $walker;
        $this->counter = $counter;
    }
}
