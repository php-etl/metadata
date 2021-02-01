<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\RelationGuesser;

use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\RelationGuesser\RelationGuesserInterface;

final class RelationGuesserChain implements RelationGuesserInterface
{
    /** @var RelationGuesserInterface[] */
    private iterable $inner;

    public function __construct(RelationGuesserInterface ...$inner)
    {
        $this->inner = $inner;
    }

    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        foreach ($this->inner as $guesser) {
            yield from $guesser($class);
        }
    }
}
