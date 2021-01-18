<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

interface ClassMetadataBuilderInterface
{
    public function buildFromReference(ClassReferenceMetadataInterface $class): ClassTypeMetadataInterface;

    public function buildFromFQCN(string $className): ClassTypeMetadataInterface;

    public function buildFromObject(object $object): ClassTypeMetadataInterface;

    public function build(\ReflectionClass $classOrObject): ClassTypeMetadataInterface;
}
