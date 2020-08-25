<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\Annotated;

interface AnnotatedInterface
{
    public function getAnnotation(): ?string;
}