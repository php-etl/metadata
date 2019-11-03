<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\FieldGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;

class FieldGuesserChain implements FieldGuesserInterface
{
    /** @var FieldGuesserInterface[] */
    private $inner;

    public function __construct(FieldGuesserInterface ...$inner)
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