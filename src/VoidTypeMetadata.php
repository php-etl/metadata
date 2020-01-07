<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class VoidTypeMetadata implements TypeMetadataInterface
{
    public function __toString()
    {
        return 'void';
    }
}