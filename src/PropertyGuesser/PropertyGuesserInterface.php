<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\PropertyGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\PropertyMetadataInterface;

interface PropertyGuesserInterface
{
    /**
     * @return PropertyMetadataInterface[]|\Generator
     */
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator;
}