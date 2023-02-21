<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Contract\Metadata\UnaryRelationMetadataInterface;

class UnaryRelationMetadata implements UnaryRelationMetadataInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(
        string $name,
        CompositeTypeMetadataInterface ...$types
    ) {
        $this->name = $name;
        $this->types = $types;
    }
}
