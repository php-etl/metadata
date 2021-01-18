<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\FieldGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\Metadata\FieldMetadataInterface;

interface FieldGuesserInterface
{
    /**
     * @param ClassTypeMetadata $class
     *
     * @return FieldMetadataInterface[]|\Generator
     */
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator;
}
