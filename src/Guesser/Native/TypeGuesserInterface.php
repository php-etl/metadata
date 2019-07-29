<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Native;

interface TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Iterator;
}