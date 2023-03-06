<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\MethodMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

/**
 * @template Subject of object
 *
 * @use VirtualUnaryTrait<Subject>
 *
 * @extends FieldMetadata<Subject>
 */
final class VirtualFieldMetadata extends FieldMetadata
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
        TypeMetadataInterface $type,
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
