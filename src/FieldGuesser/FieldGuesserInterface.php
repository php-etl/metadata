<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\FieldGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;

interface FieldGuesserInterface
{
    /**
     * @param ClassTypeMetadataInterface $class
     *
     * @return \Iterator
     */
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator;
}
