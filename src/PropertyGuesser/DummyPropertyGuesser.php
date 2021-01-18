<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\PropertyGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;

final class DummyPropertyGuesser implements PropertyGuesserInterface
{
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator
    {
        return new \EmptyIterator();
    }
}
