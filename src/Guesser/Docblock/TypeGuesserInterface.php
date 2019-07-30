<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Docblock;

interface TypeGuesserInterface
{
    public function __invoke(string $tagName, \ReflectionClass $class, \Reflector $reflector): \Iterator;
}