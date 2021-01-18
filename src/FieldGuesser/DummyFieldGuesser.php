<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\FieldGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;

final class DummyFieldGuesser implements FieldGuesserInterface
{
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        return new \EmptyIterator();
    }
}
