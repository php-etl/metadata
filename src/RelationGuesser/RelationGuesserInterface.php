<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\RelationGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\Metadata\RelationMetadataInterface;

interface RelationGuesserInterface
{
    /**
     * @return RelationMetadataInterface[]|\Generator
     */
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator;
}
