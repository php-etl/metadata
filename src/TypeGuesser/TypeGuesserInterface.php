<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\TypeGuesser;

interface TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): \Iterator;
}