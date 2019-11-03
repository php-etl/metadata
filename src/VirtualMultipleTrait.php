<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

trait VirtualMultipleTrait
{
    /** @var MethodMetadata */
    private $accessor;
    /** @var MethodMetadata */
    private $mutator;
    /** @var MethodMetadata */
    private $adder;
    /** @var MethodMetadata */
    private $remover;
    /** @var MethodMetadata */
    private $walker;
    /** @var MethodMetadata */
    private $counter;

    public function getAccessor(): ?MethodMetadata
    {
        return $this->accessor;
    }

    public function getMutator(): ?MethodMetadata
    {
        return $this->mutator;
    }

    public function getAdder(): ?MethodMetadata
    {
        return $this->adder;
    }

    public function getRemover(): ?MethodMetadata
    {
        return $this->remover;
    }

    public function getWalker(): ?MethodMetadata
    {
        return $this->walker;
    }

    public function counter(): ?MethodMetadata
    {
        return $this->counter;
    }
}