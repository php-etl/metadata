<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

trait TypedTrait
{
    /** @var TypeMetadataInterface[] */
    private $types;

    /** @return TypeMetadataInterface[] */
    public function getTypes(): iterable
    {
        return $this->types;
    }
}