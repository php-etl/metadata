<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ArgumentListMetadata implements \IteratorAggregate, ArgumentListMetadataInterface
{
    /** @var ArgumentMetadataInterface[] */
    private iterable $arguments;

    public function __construct(ArgumentMetadataInterface ...$arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return \ArrayIterator|\Traversable|ArgumentMetadataInterface[]
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->arguments);
    }

    public function count()
    {
        return count($this->arguments);
    }
}