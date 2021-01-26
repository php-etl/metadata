<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\TypeGuesser;

use Kiboko\Component\Metadata\ArrayTypeMetadata;
use Kiboko\Component\Metadata\ClassMetadataInterface;
use Kiboko\Component\Metadata\ClassReferenceMetadata;
use Kiboko\Component\Metadata\NullTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\Type;
use Kiboko\Component\Metadata\TypeMetadataInterface;
use Kiboko\Component\Metadata\VoidTypeMetadata;

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
        if (in_array($type, Type::$void)) {
            return new VoidTypeMetadata();
        }

        return new ScalarTypeMetadata($type);
    }
}
