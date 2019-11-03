<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\PropertyGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;

final class DummyPropertyGuesser implements PropertyGuesserInterface
{
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadata $class): \Iterator
    {
        return new \EmptyIterator();
    }
}