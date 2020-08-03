<?php

namespace Kiboko\Component\ETL\Metadata;

interface CollectionTypeMetadataInterface extends IterableTypeMetadataInterface
{
    public function getType(): ClassMetadataInterface;

    public function getInner(): TypeMetadataInterface;
}