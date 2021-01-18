<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\FieldGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;

final class FieldGuesserChain implements FieldGuesserInterface
{
    /** @var FieldGuesserInterface[] */
    private $inner;

    public function __construct(FieldGuesserInterface ...$inner)
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
