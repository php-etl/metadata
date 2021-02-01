<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\Annotated\AnnotatedInterface;
use Kiboko\Contract\Metadata\ClassReferenceMetadataInterface;

final class ClassReferenceMetadata implements ClassReferenceMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    public function __construct(private ClassReferenceMetadataInterface $decorated, ?string $annotation = null)
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
