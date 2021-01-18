<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\PropertyGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\Metadata\PropertyMetadataInterface;

interface PropertyGuesserInterface
{
    /**
     * @return PropertyMetadataInterface[]|\Generator
     */
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator;
}
