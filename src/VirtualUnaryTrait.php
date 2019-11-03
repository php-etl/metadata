<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

trait VirtualUnaryTrait
{
    /** @var MethodMetadata */
    private $accessor;
    /** @var MethodMetadata */
    private $mutator;
    /** @var MethodMetadata */
    private $checker;
    /** @var MethodMetadata */
    private $remover;

    public function getAccessor(): ?MethodMetadata
    {
        return $this->accessor;
    }

    public function getMutator(): ?MethodMetadata
    {
        return $this->mutator;
    }

    public function getChecker(): ?MethodMetadata
    {
        return $this->checker;
    }

    public function getRemover(): ?MethodMetadata
    {
        return $this->remover;
    }
}