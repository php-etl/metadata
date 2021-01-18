<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

final class PropertyMetadata implements PropertyMetadataInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(string $name, TypeMetadataInterface $type)
    {
        $this->name = $name;
        $this->type = $type;
    }
}
