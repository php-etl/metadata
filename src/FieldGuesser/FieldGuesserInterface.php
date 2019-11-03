<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\FieldGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\FieldMetadataInterface;

interface FieldGuesserInterface
{
    /**
     * @param ClassTypeMetadata $class
     *
     * @return FieldMetadataInterface[]|\Generator
     */
    public function __invoke(ClassTypeMetadata $class): \Iterator;
}