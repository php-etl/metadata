<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class VirtualUnaryRelationMetadata implements RelationMetadataInterface
{
    /** @var string */
    public $name;
    /** @var TypeMetadataInterface[] */
    public $types;
    /** @var MethodMetadata */
    public $accessor;
    /** @var MethodMetadata */
    public $mutator;
    /** @var MethodMetadata */
    public $checker;
    /** @var MethodMetadata */
    public $remover;

    public function __construct(
        string $name,
        ?MethodMetadata $accessor = null,
        ?MethodMetadata $mutator = null,
        ?MethodMetadata $checker = null,
        ?MethodMetadata $remover = null,
        TypeMetadataInterface ...$types
    ) {
        $this->name = $name;
        $this->types = $types;
        $this->accessor = $accessor;
        $this->mutator = $mutator;
        $this->checker = $checker;
        $this->remover = $remover;
    }
}