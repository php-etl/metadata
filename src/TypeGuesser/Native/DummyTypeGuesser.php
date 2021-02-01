<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\TypeGuesser\Native;

use Kiboko\Contract\Metadata\TypeGuesser\Native\TypeGuesserInterface;

class DummyTypeGuesser implements TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Iterator
    {
        return new \EmptyIterator();
    }
}
