<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\TypeGuesser\Docblock;

use Kiboko\Contract\Metadata\TypeGuesser\Docblock\TypeGuesserInterface;

class DummyTypeGuesser implements TypeGuesserInterface
{
    public function __invoke(string $tagName, \ReflectionClass $class, \Reflector $reflector): \Iterator
    {
        return new \EmptyIterator();
    }
}
