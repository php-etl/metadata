<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\TypeGuesser\Native;

class DummyTypeGuesser implements TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Iterator
    {
        return new \EmptyIterator();
    }
}