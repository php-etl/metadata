<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\AnnotatedInterface;
use Kiboko\Contract\Metadata\ArgumentMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class ArgumentMetadata implements ArgumentMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    public function __construct(
        private readonly ArgumentMetadataInterface $decorated,
        ?string $annotation = null
    ) {
        $this->annotation = $annotation;
    }

    public function getName(): string
    {
        return $this->decorated->getName();
    }

    public function getType(): TypeMetadataInterface
    {
        return $this->decorated->getType();
    }
}
