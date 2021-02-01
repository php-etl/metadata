<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\FieldGuesser;

use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\FieldGuesser\FieldGuesserInterface;

final class DummyFieldGuesser implements FieldGuesserInterface
{
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        return new \EmptyIterator();
    }
}
