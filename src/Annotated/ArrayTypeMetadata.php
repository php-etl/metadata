<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\Annotated;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadataInterface;

final class ArrayTypeMetadata implements ArrayTypeMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    private ArrayTypeMetadataInterface $decorated;

    public function __construct(ArrayTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->decorated = $decorated;
        $this->annotation = $annotation;
    }

    public function __toString()
    {
        return (string) $this->decorated;
    }
}