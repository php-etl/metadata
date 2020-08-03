<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\Annotated;

use Kiboko\Component\ETL\Metadata\ClassMetadataInterface;
use Kiboko\Component\ETL\Metadata\CollectionTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;

final class CollectionTypeMetadata implements CollectionTypeMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    private CollectionTypeMetadataInterface $decorated;

    public function __construct(CollectionTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->decorated = $decorated;
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

    public function __toString()
    {
        return (string) $this->decorated;
    }
}