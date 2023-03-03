<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Contract\Metadata\MethodMetadataInterface;

/**
 * @template Subject of object
 * @use VirtualUnaryTrait<Subject>
 * @extends UnaryRelationMetadata<Subject>
 */
final class VirtualUnaryRelationMetadata extends UnaryRelationMetadata
{
    use VirtualUnaryTrait;

    /**
     * @param MethodMetadataInterface<Subject>|null $accessor
     * @param MethodMetadataInterface<Subject>|null $mutator
     * @param MethodMetadataInterface<Subject>|null $checker
     * @param MethodMetadataInterface<Subject>|null $remover
     */
    public function __construct(
        string $name,
        CompositeTypeMetadataInterface $type,
        ?MethodMetadataInterface $accessor = null,
        ?MethodMetadataInterface $mutator = null,
        ?MethodMetadataInterface $checker = null,
        ?MethodMetadataInterface $remover = null,
    ) {
        parent::__construct($name, $type);

        $this->accessor = $accessor;
        $this->mutator = $mutator;
        $this->checker = $checker;
        $this->remover = $remover;
    }
}
