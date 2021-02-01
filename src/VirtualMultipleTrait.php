<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\MethodMetadataInterface;

trait VirtualMultipleTrait
{
    private ?MethodMetadataInterface $accessor;
    private ?MethodMetadataInterface $mutator;
    private ?MethodMetadataInterface $adder;
    private ?MethodMetadataInterface $remover;
    private ?MethodMetadataInterface $walker;
    private ?MethodMetadataInterface $counter;

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
