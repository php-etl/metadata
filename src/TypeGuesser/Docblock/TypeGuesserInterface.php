<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\TypeGuesser\Docblock;

interface TypeGuesserInterface
{
    public function __invoke(string $tagName, \ReflectionClass $class, \Reflector $reflector): \Iterator;
}