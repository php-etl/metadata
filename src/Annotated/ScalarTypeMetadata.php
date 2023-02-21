<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\AnnotatedInterface;
use Kiboko\Contract\Metadata\ScalarTypeMetadataInterface;

final class ScalarTypeMetadata implements ScalarTypeMetadataInterface, AnnotatedInterface, \Stringable
{
    use AnnotatedTrait;

    public function __construct(private readonly ScalarTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->annotation = $annotation;
    }

    public function __toString(): string
    {
        return (string) $this->decorated;
    }
}
