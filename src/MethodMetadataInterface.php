<?php

namespace Kiboko\Component\ETL\Metadata;

interface MethodMetadataInterface extends NamedInterface
{
    public function getArguments(): ArgumentListMetadataInterface;

    public function getReturnType(): TypeMetadataInterface;
}