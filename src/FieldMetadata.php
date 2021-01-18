<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

class FieldMetadata implements FieldMetadataInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(
        string $name,
        TypeMetadataInterface $type
    ) {
        $this->name = $name;
        $this->type = $type;
    }
}
