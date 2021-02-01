<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\MethodMetadataInterface;

trait VirtualUnaryTrait
{
    private ?MethodMetadataInterface $accessor;
    private ?MethodMetadataInterface $mutator;
    private ?MethodMetadataInterface $checker;
    private ?MethodMetadataInterface $remover;

    public function getAccessor(): ?MethodMetadataInterface
    {
        return $this->accessor;
    }

    public function getMutator(): ?MethodMetadataInterface
    {
        return $this->mutator;
    }

    public function getChecker(): ?MethodMetadataInterface
    {
        return $this->checker;
    }

    public function getRemover(): ?MethodMetadataInterface
    {
        return $this->remover;
    }
}
