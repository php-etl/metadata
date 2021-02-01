<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\MethodGuesser;

use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\MethodGuesser\MethodGuesserInterface;

final class DummyMethodGuesser implements MethodGuesserInterface
{
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator
    {
        return new \EmptyIterator();
    }
}
