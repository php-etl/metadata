<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ListTypeMetadata implements IterableTypeMetadataInterface
{
    /** @var TypeMetadataInterface */
    public $inner;

    public function __construct(TypeMetadataInterface $inner)
    {
        $this->inner = $inner;
    }

    public function __toString()
    {
        return $this->inner.'[]';
    }
}