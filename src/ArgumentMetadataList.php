<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ArgumentMetadataList implements \IteratorAggregate
{
    /** @var ArgumentMetadataInterface[] */
    public $arguments;

    public function __construct(ArgumentMetadataInterface ...$arguments)
    {
        $this->arguments = $arguments;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->arguments);
    }
}