<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\RelationGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;

final class DummyRelationGuesser implements RelationGuesserInterface
{
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        return new \EmptyIterator();
    }
}
