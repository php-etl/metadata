<?php

namespace Kiboko\Component\ETL\Metadata;

final class Type
{
    /** @internal */
    public static $boolean = ['bool', 'boolean'];
    /** @internal */
    public static $integer = ['int', 'integer'];
    /** @internal */
    public static $float = ['float', 'decimal', 'double'];
    /** @internal */
    public static $numberMeta = ['numeric', 'number'];
    /** @internal */
    public static $numberCompatible = ['int', 'integer', 'float', 'decimal', 'double', 'numeric', 'number'];
    /** @internal */
    public static $string = ['string'];
    /** @internal */
    public static $array = ['array'];
    /** @internal */
    public static $iterable = ['iterable'];
    /** @internal */
    public static $callable = ['callable'];
    /** @internal */
    public static $resource = ['resource'];
    /** @internal */
    public static $null = ['null'];
    /** @internal */
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
     * @param TypeMetadataInterface[] $left
     * @param TypeMetadataInterface[] $right
     *
     * @return TypeMetadataInterface[]
     */
    public static function isSubsetOf(iterable $left, iterable $right): iterable
    {
        foreach ($left as $type) {
            if (self::isOneOf($type, ...$right)) {
                yield $type;
            }
        }
    }

    public static function isOneOf(TypeMetadataInterface $expected, TypeMetadataInterface ...$actual): bool
    {
        foreach ($actual as $type) {
            if (self::is($expected, $type)) {
                return true;
            }
        }

        return false;
    }

    public static function is(TypeMetadataInterface $expected, TypeMetadataInterface $actual): bool
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
                is_a((string) $expected->inner, (string) $actual->inner);
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