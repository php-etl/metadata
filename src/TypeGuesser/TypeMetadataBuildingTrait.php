<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\TypeGuesser;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\ClassMetadataInterface;
use Kiboko\Component\ETL\Metadata\ClassReferenceMetadata;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\Type;
use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;

trait TypeMetadataBuildingTrait
{
    private function classReferenceType(string $type): ClassMetadataInterface
    {
        try {
            $classReflector = new \ReflectionClass($type);
        } catch (\ReflectionException $e) {
            return new ClassReferenceMetadata(ltrim($type, '\\'));
        }

        return new ClassReferenceMetadata(
            $classReflector->getShortName(),
            $classReflector->getNamespaceName()
        );
    }

    private function builtInType(string $type): TypeMetadataInterface
    {
        if (in_array($type, Type::$array)) {
            return new ArrayTypeMetadata();
        }
        if (in_array($type, Type::$null)) {
            return new NullTypeMetadata();
        }

        return new ScalarTypeMetadata($type);
    }
}