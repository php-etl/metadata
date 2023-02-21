<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\MethodMetadataInterface;

trait VirtualMultipleTrait
{
    private ?MethodMetadataInterface $accessor = null;
    private ?MethodMetadataInterface $mutator = null;
    private ?MethodMetadataInterface $adder = null;
    private ?MethodMetadataInterface $remover = null;
    private ?MethodMetadataInterface $walker = null;
    private ?MethodMetadataInterface $counter = null;

    public function getAccessor(): ?MethodMetadataInterface
    {
        return $this->accessor;
    }

    public function getMutator(): ?MethodMetadataInterface
    {
        return $this->mutator;
    }

    public function getAdder(): ?MethodMetadataInterface
    {
        return $this->adder;
    }

    public function getRemover(): ?MethodMetadataInterface
    {
        return $this->remover;
    }

    public function getWalker(): ?MethodMetadataInterface
    {
        return $this->walker;
    }

    public function counter(): ?MethodMetadataInterface
    {
        return $this->counter;
    }
}
