<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassReferenceMetadataInterface;

final readonly class ClassReferenceMetadata implements ClassReferenceMetadataInterface, \Stringable
{
    public function __construct(
        private string $name,
        private ?string $namespace = null
    ) {
        if (str_contains($this->name, '\\')) {
            throw new \RuntimeException('Class names should not contain root namespace anchoring backslash or namespace.');
        }
        if (null !== $this->namespace && str_starts_with($this->namespace, '\\')) {
            throw new \RuntimeException('Namespace should not contain root namespace anchoring backslash.');
        }
    }

    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return (null !== $this->namespace ? $this->namespace.'\\' : '').$this->name;
    }
}
