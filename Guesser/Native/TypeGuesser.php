<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Native;

interface TypeGuesser
{
    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Generator;
}