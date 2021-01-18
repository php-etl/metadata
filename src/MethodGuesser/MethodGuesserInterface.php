<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\MethodGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\Metadata\MethodMetadataInterface;

interface MethodGuesserInterface
{
    /**
     * @return MethodMetadataInterface[]|\Iterator
     */
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator;
}
