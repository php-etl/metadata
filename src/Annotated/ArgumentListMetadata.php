<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\AnnotatedInterface;
use Kiboko\Contract\Metadata\ArgumentListMetadataInterface;

final class ArgumentListMetadata implements ArgumentListMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    public function __construct(
        private readonly ArgumentListMetadataInterface $decorated,
        ?string $annotation = null
    ) {
        $this->annotation = $annotation;
    }

    public function count(): int
    {
        return $this->decorated->count();
    }
}
