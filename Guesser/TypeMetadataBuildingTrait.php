<?php

namespace Kiboko\Component\ETL\Metadata\Guesser;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\Type;

trait TypeMetadataBuildingTrait
{
    private function discoverFQCN(string $name, \ReflectionClass $reflection): string
    {
        if (substr($name, 0, 1) === '\\') {
            return substr($name, 1);
        }

        if ($reflection->isAnonymous()) {
            return $name;
        }

        return $reflection->getNamespaceName() . '\\' . $name;
    }

    private function simpleType(string $type, bool $isFullyQualified, \ReflectionClass $reflector)
    {
        if (!in_array($type, Type::$builtInTypes)) {
            return new ClassTypeMetadata($isFullyQualified ? substr($type, 1) : $this->discoverFQCN($type, $reflector));
        }
        if (in_array($type, Type::$array)) {
            return new ArrayTypeMetadata();
        }
        if (in_array($type, Type::$null)) {
            return new NullTypeMetadata();
        }

        return new ScalarTypeMetadata($type);
    }

    private function listType(?string $iterated, bool $isFullyQualified, \ReflectionClass $reflector)
    {
        if ($iterated === null) {
            return new ArrayTypeMetadata();
        }

        return new ListTypeMetadata(
            $this->simpleType($iterated, $isFullyQualified, $reflector)
        );
    }
}