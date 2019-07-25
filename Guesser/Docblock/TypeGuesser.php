<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Docblock;

interface TypeGuesser
{
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): \Generator;
}