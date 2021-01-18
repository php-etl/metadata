<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Component\Metadata\ScalarTypeMetadataInterface;

final class ScalarTypeMetadata implements ScalarTypeMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    private ScalarTypeMetadataInterface $decorated;

    public function __construct(ScalarTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->decorated = $decorated;
        $this->annotation = $annotation;
    }

    public function __toString()
    {
        return (string) $this->decorated;
    }
}
