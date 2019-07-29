<?php

namespace Kiboko\Component\ETL\Metadata;

final class ClassReferenceMetadata implements ClassMetadataInterface
{
    /** @var string|null */
    public $namespace;
    /** @var string */
    public $name;

    public function __construct(string $name, ?string $namespace = null)
    {
        if (strpos($name, '\\') === 0) {
            throw new \RuntimeException('Class names should not contain root namespace anchoring backslash.');
        }
        if ($namespace !== null && strpos($namespace, '\\') === 0) {
            throw new \RuntimeException('Namespace should not contain root namespace anchoring backslash.');
        }

        $this->name = $name;
        $this->namespace = $namespace;
    }

    public function __toString()
    {
        return ($this->namespace !== null ? $this->namespace . '\\' : '') . $this->name;
    }
}