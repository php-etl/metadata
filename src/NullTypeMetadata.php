<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

final class NullTypeMetadata implements TypeMetadataInterface
{
    public function __toString()
    {
        return 'null';
    }
}
