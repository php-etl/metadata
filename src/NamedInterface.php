<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

interface NamedInterface
{
    public function getName(): string;
}