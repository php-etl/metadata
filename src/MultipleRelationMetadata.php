<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\IterableTypeMetadataInterface;
use Kiboko\Contract\Metadata\MultipleRelationMetadataInterface;

class MultipleRelationMetadata implements MultipleRelationMetadataInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(string $name, IterableTypeMetadataInterface $types)
    {
        $this->name = $name;
        $this->type = $types;
    }
}
