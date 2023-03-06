<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\IterableTypeMetadataInterface;
use Kiboko\Contract\Metadata\MultipleRelationMetadataInterface;

/**
 * @template Subject of object
 *
 * @implements MultipleRelationMetadataInterface<Subject>
 */
class MultipleRelationMetadata implements MultipleRelationMetadataInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(
        string $name,
        IterableTypeMetadataInterface $type,
    ) {
        $this->name = $name;
        $this->type = $type;
    }
}
