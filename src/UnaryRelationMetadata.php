<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Contract\Metadata\UnaryRelationMetadataInterface;

/**
 * @template Subject of object
 *
 * @implements UnaryRelationMetadataInterface<Subject>
 */
class UnaryRelationMetadata implements UnaryRelationMetadataInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(
        string $name,
        CompositeTypeMetadataInterface $type,
    ) {
        $this->name = $name;
        $this->type = $type;
    }
}
