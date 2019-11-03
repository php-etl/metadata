<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

interface ClassMetadataBuilderInterface
{
    public function buildFromReference(ClassReferenceMetadata $class): ClassTypeMetadata;
    
    public function buildFromFQCN(string $className): ClassTypeMetadata;

    public function buildFromObject(object $object): ClassTypeMetadata;

    public function build(\ReflectionClass $classOrObject): ClassTypeMetadata;
}