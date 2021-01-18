<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

trait TypedTrait
{
    private TypeMetadataInterface $type;

    public function getType(): TypeMetadataInterface
    {
        return $this->type;
    }
}
