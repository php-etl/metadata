<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\RelationGuesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\RelationMetadataInterface;

interface RelationGuesserInterface
{
    /**
     * @return RelationMetadataInterface[]|\Generator
     */
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator;
}