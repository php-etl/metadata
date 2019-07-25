<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Native;

class DummyTypeGuesser implements TypeGuesser
{
    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Generator
    {
        return;
        yield;
    }
}