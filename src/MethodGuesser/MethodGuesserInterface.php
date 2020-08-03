<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\MethodGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\MethodMetadataInterface;

interface MethodGuesserInterface
{
    /**
     * @return MethodMetadataInterface[]|\Iterator
     */
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator;
}