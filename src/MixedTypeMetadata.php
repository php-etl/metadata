<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class MixedTypeMetadata implements TypeMetadataInterface
{
    public function __toString()
    {
        return 'mixed';
    }
}