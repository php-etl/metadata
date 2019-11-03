<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\FieldGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;

final class DummyFieldGuesser implements FieldGuesserInterface
{
    public function __invoke(ClassTypeMetadata $class): \Iterator
    {
        return new \EmptyIterator();
    }
}