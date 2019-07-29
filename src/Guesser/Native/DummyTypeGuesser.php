<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Native;

class DummyTypeGuesser implements TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Iterator
    {
        return new \EmptyIterator();
    }
}