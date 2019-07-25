<?php

namespace Kiboko\Component\ETL\Metadata\Guesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;

trait TypeMetadataBuildingTrait
{
    private static $builtInTypes = [
        'bool', 'boolean',
        'int', 'integer',
        'float', 'decimal', 'double',
        'numeric', 'number',
        'string',
        'array', 'iterable',
        'object',
        'callable',
        'resource',
        'null'
    ];

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
        if (!in_array($type, self::$builtInTypes)) {
            return new ClassTypeMetadata($isFullyQualified ? substr($type, 1) : $this->discoverFQCN($type, $reflector));
        }

        return new ScalarTypeMetadata($type);
    }

    private function listType(string $type, ?string $iterated, bool $isFullyQualified, \ReflectionClass $reflector)
    {
        if ($iterated === null) {
            return new ScalarTypeMetadata($type);
        }

        return new ListTypeMetadata(
            $this->simpleType($iterated, $isFullyQualified, $reflector)
        );
    }
}