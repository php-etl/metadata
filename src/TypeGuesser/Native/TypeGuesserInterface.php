<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\TypeGuesser\Native;

interface TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Iterator;
}
