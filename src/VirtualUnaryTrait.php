<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\MethodMetadataInterface;

/**
 * @template Subject of object
 */
trait VirtualUnaryTrait
{
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $accessor = null;
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $mutator = null;
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $checker = null;
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $remover = null;

    /**
     * @return MethodMetadataInterface<Subject>|null
     */
    public function getAccessor(): ?MethodMetadataInterface
    {
        return $this->accessor;
    }

    /**
     * @return MethodMetadataInterface<Subject>|null
     */
    public function getMutator(): ?MethodMetadataInterface
    {
        return $this->mutator;
    }

    /**
     * @return MethodMetadataInterface<Subject>|null
     */
    public function getChecker(): ?MethodMetadataInterface
    {
        return $this->checker;
    }

    /**
     * @return MethodMetadataInterface<Subject>|null
     */
    public function getRemover(): ?MethodMetadataInterface
    {
        return $this->remover;
    }
}
