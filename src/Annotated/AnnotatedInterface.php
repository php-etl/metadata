<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

interface AnnotatedInterface
{
    public function getAnnotation(): ?string;
}
