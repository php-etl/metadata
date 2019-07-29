<?php

namespace Kiboko\Component\ETL\Metadata\Guesser;

interface TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): \Iterator;
}