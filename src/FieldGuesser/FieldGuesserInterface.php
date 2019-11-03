<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\FieldGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;

interface FieldGuesserInterface
{
    /**
     * @param ClassTypeMetadata $class
     *
     * @return FieldDefinitionInterface[]|\Generator
     */
    public function __invoke(ClassTypeMetadata $class): \Iterator;
}