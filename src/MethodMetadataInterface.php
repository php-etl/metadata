<?php

namespace Kiboko\Component\Metadata;

interface MethodMetadataInterface extends NamedInterface
{
    public function getArguments(): ArgumentListMetadataInterface;

    public function getReturnType(): TypeMetadataInterface;
}
