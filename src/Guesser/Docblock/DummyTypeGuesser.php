<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Docblock;

class DummyTypeGuesser implements TypeGuesserInterface
{
    public function __invoke(string $tagName, \ReflectionClass $class, \Reflector $reflector): \Iterator
    {
        return new \EmptyIterator();
    }
}