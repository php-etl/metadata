<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\AnnotatedInterface;
use Kiboko\Contract\Metadata\ScalarTypeMetadataInterface;

final class ScalarTypeMetadata implements ScalarTypeMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    public function __construct(private ScalarTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->annotation = $annotation;
    }

    public function __toString()
    {
        return (string) $this->decorated;
    }
}
