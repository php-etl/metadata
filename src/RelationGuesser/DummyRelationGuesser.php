<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\RelationGuesser;

use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\RelationGuesser\RelationGuesserInterface;

final class DummyRelationGuesser implements RelationGuesserInterface
{
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        return new \EmptyIterator();
    }
}
