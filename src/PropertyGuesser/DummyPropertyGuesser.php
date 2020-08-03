<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\PropertyGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadataInterface;

final class DummyPropertyGuesser implements PropertyGuesserInterface
{
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator
    {
        return new \EmptyIterator();
    }
}