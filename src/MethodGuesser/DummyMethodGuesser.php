<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\MethodGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;

final class DummyMethodGuesser implements MethodGuesserInterface
{
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator
    {
        return new \EmptyIterator();
    }
}
