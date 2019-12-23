<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ArrayEntryMetadata implements NamedInterface, TypedInterface
{
    use NamedTrait;
    use TypedTrait;

    public function __construct(string $name, TypeMetadataInterface $type)
    {
        $this->name = $name;
        $this->type = $type;
    }
}