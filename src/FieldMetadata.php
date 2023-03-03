<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\FieldMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

/**
 * @template Subject of object
 * @implements FieldMetadataInterface<Subject>
 */
class FieldMetadata implements FieldMetadataInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(
        string $name,
        TypeMetadataInterface $type,
    ) {
        $this->name = $name;
        $this->type = $type;
    }
}
