<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\RelationGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;

class RelationGuesserChain implements RelationGuesserInterface
{
    /** @var RelationGuesserInterface[] */
    private $inner;

    public function __construct(RelationGuesserInterface ...$inner)
    {
        $this->inner = $inner;
    }

    public function __invoke(ClassTypeMetadata $class): \Generator
    {
        foreach ($this->inner as $guesser) {
            yield from $guesser($class);
        }
    }
}