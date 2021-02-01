<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassReferenceMetadataInterface;

final class ClassReferenceMetadata implements ClassReferenceMetadataInterface
{
    public function __construct(
        private string $name,
        private ?string $namespace = null
    ) {
        if (str_contains($this->name, '\\')) {
            throw new \RuntimeException('Class names should not contain root namespace anchoring backslash or namespace.');
        }
        if ($this->namespace !== null && strpos($this->namespace, '\\') === 0) {
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
        return ($this->namespace !== null ? $this->namespace . '\\' : '') . $this->name;
    }
}
