<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ArgumentListMetadata implements \IteratorAggregate, \Countable
{
    /** @var ArgumentMetadataInterface[] */
    private $arguments;

    public function __construct(ArgumentMetadataInterface ...$arguments)
    {
        $this->arguments = $arguments;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->arguments);
    }

    public function count()
    {
        return count($this->arguments);
    }
}