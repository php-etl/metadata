<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\Annotated\AnnotatedInterface;
use Kiboko\Contract\Metadata\ClassMetadataInterface;
use Kiboko\Contract\Metadata\CollectionTypeMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class CollectionTypeMetadata implements CollectionTypeMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    public function __construct(private CollectionTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->annotation = $annotation;
    }

    public function getType(): ClassMetadataInterface
    {
        return $this->decorated->getType();
    }

    public function getInner(): TypeMetadataInterface
    {
        return $this->decorated->getInner();
    }

    public function __toString(): string
    {
        return (string) $this->decorated;
    }
}
