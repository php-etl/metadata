<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

trait AnnotatedTrait
{
    private ?string $annotation = null;

    public function getAnnotation(): ?string
    {
        return $this->annotation;
    }
}
