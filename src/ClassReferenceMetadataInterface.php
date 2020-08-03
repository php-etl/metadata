<?php

namespace Kiboko\Component\ETL\Metadata;

interface ClassReferenceMetadataInterface extends ClassMetadataInterface
{
    public function getNamespace(): ?string;

    public function getName(): string;
}