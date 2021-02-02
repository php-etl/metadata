<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassMetadataInterface;
use Kiboko\Contract\Metadata\CollectionTypeMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class CollectionTypeMetadata implements CollectionTypeMetadataInterface
{
    public function __construct(
        private ClassMetadataInterface $type,
        private TypeMetadataInterface $inner
    ) {
    }

    public function __toString(): string
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
