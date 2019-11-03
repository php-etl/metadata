<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\TypeGuesser\Docblock;

class DummyTypeGuesser implements TypeGuesserInterface
{
    public function __invoke(string $tagName, \ReflectionClass $class, \Reflector $reflector): \Iterator
    {
        return new \EmptyIterator();
    }
}