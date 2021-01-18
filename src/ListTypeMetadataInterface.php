<?php

namespace Kiboko\Component\Metadata;

interface ListTypeMetadataInterface extends IterableTypeMetadataInterface
{
    public function getInner(): TypeMetadataInterface;
}
