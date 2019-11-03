<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\RelationGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;

final class DummyRelationGuesser implements RelationGuesserInterface
{
    public function __invoke(ClassTypeMetadata $class): \Iterator
    {
        return new \EmptyIterator();
    }
}