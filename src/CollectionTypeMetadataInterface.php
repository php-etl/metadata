<?php

namespace Kiboko\Component\Metadata;

interface CollectionTypeMetadataInterface extends IterableTypeMetadataInterface
{
    public function getType(): ClassMetadataInterface;

    public function getInner(): TypeMetadataInterface;
}
