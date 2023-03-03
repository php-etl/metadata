<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ArgumentListMetadataInterface;
use Kiboko\Contract\Metadata\ArgumentMetadataInterface;

/**
 * @implements \IteratorAggregate<ArgumentMetadataInterface>
 */
final class ArgumentListMetadata implements \IteratorAggregate, ArgumentListMetadataInterface
{
    /** @var list<ArgumentMetadataInterface> */
    private readonly array $arguments;

    public function __construct(ArgumentMetadataInterface ...$arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return \Traversable<ArgumentMetadataInterface>
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->arguments);
    }

    public function count(): int
    {
        return \count($this->arguments);
    }
}
