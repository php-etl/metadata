<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

final class ListTypeMetadata implements ListTypeMetadataInterface
{
    private TypeMetadataInterface $inner;

    public function __construct(TypeMetadataInterface $inner)
    {
        $this->inner = $inner;
    }

    public function __toString()
    {
        return $this->inner.'[]';
    }

    public function getInner(): TypeMetadataInterface
    {
        return $this->inner;
    }
}
