<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

trait NamedTrait
{
    /** @var string */
    private $name;

    public function getName(): string
    {
        return $this->name;
    }
}