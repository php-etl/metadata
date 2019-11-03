<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\PropertyGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\PropertyMetadata;

interface PropertyGuesserInterface
{
    /**
     * @return PropertyMetadata[]|\Generator
     */
    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadata $class): \Iterator;
}