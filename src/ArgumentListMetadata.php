<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ArgumentListMetadataInterface;
use Kiboko\Contract\Metadata\ArgumentMetadataInterface;

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
    public function getIterator(): array|\Traversable|\ArrayIterator
    {
        return new \ArrayIterator($this->arguments);
    }

    public function count(): int
    {
        return count($this->arguments);
    }
}
