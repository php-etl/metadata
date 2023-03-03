<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ArrayEntryMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class ArrayEntryMetadata implements ArrayEntryMetadataInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(string $name, TypeMetadataInterface $type)
    {
        $this->name = $name;
        $this->type = $type;
    }
}
