<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\MethodGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\MethodMetadata;

final class DummyMethodGuesser implements MethodGuesserInterface
{
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadata $class): \Iterator
    {
        return new \EmptyIterator();
    }
}