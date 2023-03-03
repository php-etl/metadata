<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassReferenceMetadataInterface;

/**
 * @template Subject of object
 * @implements ClassReferenceMetadataInterface<Subject>
 */
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

    /**
     * @param class-string<Subject> $fqcn
     */
    public static function fromClassName(string $fqcn): self
    {
        if (($index = strrpos($fqcn, '\\')) === false) {
            return new self($fqcn);
        } else {
            return new self(
                substr($fqcn, $index + 1),
                substr($fqcn, 0, $index)
            );
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

    /**
     * @return class-string<Subject>
     */
    public function __toString(): string
    {
        return (null !== $this->namespace ? $this->namespace.'\\' : '').$this->name;
    }
}
