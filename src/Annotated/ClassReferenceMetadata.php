<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Component\Metadata\ClassReferenceMetadataInterface;

final class ClassReferenceMetadata implements ClassReferenceMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    private ClassReferenceMetadataInterface $decorated;

    public function __construct(ClassReferenceMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->decorated = $decorated;
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

    public function __toString()
    {
        return (string) $this->decorated;
    }
}
