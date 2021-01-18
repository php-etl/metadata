<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Component\Metadata\ArgumentListMetadataInterface;

final class ArgumentListMetadata implements ArgumentListMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    private ArgumentListMetadataInterface $decorated;

    public function __construct(ArgumentListMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->decorated = $decorated;
        $this->annotation = $annotation;
    }

    public function count()
    {
        return $this->decorated->count();
    }
}
