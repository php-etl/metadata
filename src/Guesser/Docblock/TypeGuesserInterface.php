<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Docblock;

interface TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): \Iterator;
}