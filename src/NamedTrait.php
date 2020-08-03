<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

trait NamedTrait
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }
}