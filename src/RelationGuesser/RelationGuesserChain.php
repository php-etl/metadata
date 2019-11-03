<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\RelationGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;

final class RelationGuesserChain implements RelationGuesserInterface
{
    /** @var RelationGuesserInterface[] */
    private $inner;

    public function __construct(RelationGuesserInterface ...$inner)
    {
        $this->inner = $inner;
    }

    public function __invoke(ClassTypeMetadata $class): \Iterator
    {
        foreach ($this->inner as $guesser) {
            yield from $guesser($class);
        }
    }
}