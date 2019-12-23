<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

interface TypedInterface
{
    public function getType(): TypeMetadataInterface;
}