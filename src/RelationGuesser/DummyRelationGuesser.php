<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\RelationGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadataInterface;

final class DummyRelationGuesser implements RelationGuesserInterface
{
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        return new \EmptyIterator();
    }
}