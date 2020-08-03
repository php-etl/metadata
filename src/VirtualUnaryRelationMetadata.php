<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class VirtualUnaryRelationMetadata extends UnaryRelationMetadata
{
    use VirtualUnaryTrait;

    public function __construct(
        string $name,
        TypeMetadataInterface $type,
        ?MethodMetadataInterface $accessor = null,
        ?MethodMetadataInterface $mutator = null,
        ?MethodMetadataInterface $checker = null,
        ?MethodMetadataInterface $remover = null
    ) {
        parent::__construct($name, $type);

        $this->accessor = $accessor;
        $this->mutator = $mutator;
        $this->checker = $checker;
        $this->remover = $remover;
    }
}