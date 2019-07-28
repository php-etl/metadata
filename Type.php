<?php

namespace Kiboko\Component\ETL\Metadata;

class Type
{
    public static $boolean = ['bool', 'boolean'];
    public static $integer = ['int', 'integer'];
    public static $float = ['float', 'decimal', 'double'];
    public static $numberMeta = ['numeric', 'number'];
    public static $numberCompatible = ['int', 'integer', 'float', 'decimal', 'double', 'numeric', 'number'];
    public static $string = ['string'];
    public static $array = ['array'];
    public static $iterable = ['iterable'];
    public static $callable = ['callable'];
    public static $resource = ['resource'];
    public static $null = ['null'];

    public static $builtInTypes = [
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

    /**
     * @param TypeMetadata[] $left
     * @param TypeMetadata[] $right
     *
     * @return TypeMetadata[]
     */
    public static function subsetOf(iterable $left, iterable $right): iterable
    {
        foreach ($left as $type) {
            if (self::isOneOf($type, $right)) {
                yield $type;
            }
        }
    }

    public static function isOneOf(TypeMetadata $expected, TypeMetadata ...$actual): bool
    {
        foreach ($actual as $type) {
            if (self::is($expected, $type)) {
                return true;
            }
        }

        return false;
    }

    public static function is(TypeMetadata $expected, TypeMetadata $actual): bool
    {
        if (($expected instanceof ClassTypeMetadata || $expected instanceof ClassReferenceMetadata) &&
            ($actual instanceof ClassTypeMetadata || $actual instanceof ClassReferenceMetadata)
        ) {
            return is_a((string) $expected, (string) $actual);
        }
        if ($expected instanceof ListTypeMetadata && $actual instanceof ListTypeMetadata) {
            return self::is($expected->inner, $actual->inner);
        }
        if ($expected instanceof CollectionTypeMetadata && $actual instanceof CollectionTypeMetadata) {
            return self::is($expected->type, $actual->type) &&
                is_a($expected->inner, $actual->inner);
        }
        if ($expected instanceof ScalarTypeMetadata && $actual instanceof ScalarTypeMetadata &&
            $expected->name === $actual->name
        ) {
            return (in_array($expected->name, self::$boolean) && in_array($actual->name, self::$boolean)) ||
                (in_array($expected->name, self::$integer) && in_array($actual->name, self::$integer)) ||
                (in_array($expected->name, self::$float) && in_array($actual->name, self::$float)) ||
                (in_array($expected->name, self::$numberMeta) && in_array($actual->name, self::$numberCompatible)) ||
                (in_array($expected->name, self::$integer) && in_array($actual->name, self::$numberMeta)) ||
                (in_array($expected->name, self::$float) && in_array($actual->name, self::$numberMeta)) ||
                (in_array($expected->name, self::$string) && in_array($actual->name, self::$string)) ||
                (in_array($expected->name, self::$array) && in_array($actual->name, self::$array)) ||
                (in_array($expected->name, self::$iterable) && (in_array($actual->name, self::$iterable) || in_array($actual->name, self::$array))) ||
                (in_array($expected->name, self::$callable) && (in_array($actual->name, self::$callable) || in_array($actual->name, self::$array))) ||
                (in_array($expected->name, self::$resource) && in_array($actual->name, self::$resource))
            ;
        }

        return $expected == $actual;
    }
}