<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ClassReferenceMetadata implements ClassReferenceMetadataInterface
{
    private ?string $namespace;
    private string $name;

    public function __construct(string $name, ?string $namespace = null)
    {
        if (strpos($name, '\\') !== false) {
            throw new \RuntimeException('Class names should not contain root namespace anchoring backslash or namespace.');
        }
        if ($namespace !== null && strpos($namespace, '\\') === 0) {
            throw new \RuntimeException('Namespace should not contain root namespace anchoring backslash.');
        }

        $this->name = $name;
        $this->namespace = $namespace;
    }

    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString()
    {
        return ($this->namespace !== null ? $this->namespace . '\\' : '') . $this->name;
    }
}