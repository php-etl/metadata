<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class MixedTypeMetadata implements TypeMetadataInterface
{
    public function __toString(): string
    {
        return 'mixed';
    }
}
