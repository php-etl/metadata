<?php

namespace Kiboko\Component\ETL\Metadata\Guesser;

interface TypeGuesser
{
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): \Generator;
}