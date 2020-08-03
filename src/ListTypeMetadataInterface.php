<?php

namespace Kiboko\Component\ETL\Metadata;

interface ListTypeMetadataInterface extends IterableTypeMetadataInterface
{
    public function getInner(): TypeMetadataInterface;
}