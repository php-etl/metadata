<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ListTypeMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final readonly class ListTypeMetadata implements ListTypeMetadataInterface, \Stringable
{
    public function __construct(private TypeMetadataInterface $inner)
    {
    }

    public function __toString(): string
    {
        return $this->inner.'[]';
    }

    public function getInner(): TypeMetadataInterface
    {
        return $this->inner;
    }
}
