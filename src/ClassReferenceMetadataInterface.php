<?php

namespace Kiboko\Component\Metadata;

interface ClassReferenceMetadataInterface extends ClassMetadataInterface
{
    public function getNamespace(): ?string;

    public function getName(): string;
}
