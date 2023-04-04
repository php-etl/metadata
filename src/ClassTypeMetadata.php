<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;

/**
 * @template Subject of object
 *
 * @implements ClassTypeMetadataInterface<Subject>
 *
 * @use ClassPropertiesTrait<Subject>
 * @use ClassMethodsTrait<Subject>
 * @use ClassFieldsTrait<Subject>
 * @use ClassRelationsTrait<Subject>
 */
final class ClassTypeMetadata implements ClassTypeMetadataInterface, \Stringable
{
    use ClassPropertiesTrait;
    use ClassMethodsTrait;
    use ClassFieldsTrait;
    use ClassRelationsTrait;

    public function __construct(
        private readonly ?string $name,
        private readonly ?string $namespace = null
    ) {
        if (null !== $this->name && str_contains($this->name, '\\')) {
            throw new \RuntimeException('Class names should not contain root namespace anchoring backslash or namespace.');
        }
        if (null !== $this->namespace && str_starts_with($this->namespace, '\\')) {
            throw new \RuntimeException('Namespace should not contain root namespace anchoring backslash.');
        }

        $this->fields = [];
        $this->relations = [];
    }

    /**
     * @param class-string<Subject> $fqcn
     */
    public static function fromClassName(string $fqcn): self
    {
        if (($index = strrpos($fqcn, '\\')) === false) {
            return new self($fqcn);
        }

        return new self(
            substr($fqcn, $index + 1),
            substr($fqcn, 0, $index)
        );
    }

    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    public function getName(): ?string
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
