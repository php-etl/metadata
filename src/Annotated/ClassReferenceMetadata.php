<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\AnnotatedInterface;
use Kiboko\Contract\Metadata\ClassReferenceMetadataInterface;

/**
 * @template Subject of object
 *
 * @implements ClassReferenceMetadataInterface<Subject>
 */
final class ClassReferenceMetadata implements ClassReferenceMetadataInterface, AnnotatedInterface, \Stringable
{
    use AnnotatedTrait;

    /**
     * @param ClassReferenceMetadataInterface<Subject> $decorated
     */
    public function __construct(private readonly ClassReferenceMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->annotation = $annotation;
    }

    public function getNamespace(): ?string
    {
        return $this->decorated->getNamespace();
    }

    public function getName(): string
    {
        return $this->decorated->getName();
    }

    public function __toString(): string
    {
        return (string) $this->decorated;
    }
}
