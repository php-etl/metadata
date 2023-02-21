<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class VoidTypeMetadata implements TypeMetadataInterface, \Stringable
{
    public function __toString(): string
    {
        return 'void';
    }
}
