<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\MethodMetadataInterface;

/**
 * @template Subject of object
 */
trait VirtualMultipleTrait
{
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $accessor = null;
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $mutator = null;
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $adder = null;
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $remover = null;
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $walker = null;
    /** @var MethodMetadataInterface<Subject>|null */
    private ?MethodMetadataInterface $counter = null;

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
    public function getAdder(): ?MethodMetadataInterface
    {
        return $this->adder;
    }

    /**
     * @return MethodMetadataInterface<Subject>|null
     */
    public function getRemover(): ?MethodMetadataInterface
    {
        return $this->remover;
    }

    /**
     * @return MethodMetadataInterface<Subject>|null
     */
    public function getWalker(): ?MethodMetadataInterface
    {
        return $this->walker;
    }

    /**
     * @return MethodMetadataInterface<Subject>|null
     */
    public function counter(): ?MethodMetadataInterface
    {
        return $this->counter;
    }
}
