<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class CollectionTypeMetadata implements IterableTypeMetadataInterface
{
    /** @var ClassMetadataInterface */
    private $type;
    /** @var TypeMetadataInterface */
    private $inner;

    public function __construct(ClassMetadataInterface $type, TypeMetadataInterface $inner)
    {
        $this->type = $type;
        $this->inner = $inner;
    }

    public function __toString()
    {
        return sprintf('%s<%s>', (string) $this->type, (string) $this->inner);
    }

    public function getType(): ClassMetadataInterface
    {
        return $this->type;
    }

    public function getInner(): TypeMetadataInterface
    {
        return $this->inner;
    }
}