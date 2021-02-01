<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\MethodMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class VirtualMultipleRelationMetadata extends MultipleRelationMetadata
{
    use VirtualMultipleTrait;

    public function __construct(
        string $name,
        TypeMetadataInterface $type,
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
