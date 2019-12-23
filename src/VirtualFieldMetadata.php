<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class VirtualFieldMetadata extends FieldMetadata
{
    use VirtualUnaryTrait;

    public function __construct(
        string $name,
        TypeMetadataInterface $type,
        ?MethodMetadata $accessor = null,
        ?MethodMetadata $mutator = null,
        ?MethodMetadata $checker = null,
        ?MethodMetadata $remover = null
    ) {
        parent::__construct($name, $type);

        $this->accessor = $accessor;
        $this->mutator = $mutator;
        $this->checker = $checker;
        $this->remover = $remover;
    }
}