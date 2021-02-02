<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\AnnotatedInterface;
use Kiboko\Contract\Metadata\ArrayTypeMetadataInterface;

final class ArrayTypeMetadata implements ArrayTypeMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    public function __construct(private ArrayTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->annotation = $annotation;
    }

    public function __toString(): string
    {
        return (string) $this->decorated;
    }
}
