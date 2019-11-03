<?php declare(strict_types=1);

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
            return self::is($expected->getInner(), $actual->getInner());
        }
        if ($expected instanceof CollectionTypeMetadata && $actual instanceof CollectionTypeMetadata) {
            return self::is($expected->getType(), $actual->getType()) &&
                is_a((string) $expected->getInner(), (string) $actual->getInner());
        }
        if ($expected instanceof ScalarTypeMetadata && $actual instanceof ScalarTypeMetadata) {
            return ((string) $expected) === ((string) $actual) ||
                (in_array(((string) $expected), self::$boolean) && in_array(((string) $actual), self::$boolean)) ||
                (in_array(((string) $expected), self::$integer) && in_array(((string) $actual), self::$integer)) ||
                (in_array(((string) $expected), self::$float) && in_array(((string) $actual), self::$float)) ||
                (in_array(((string) $expected), self::$numberCompatible) && in_array(((string) $actual), self::$numberMeta)) ||
                (in_array(((string) $expected), self::$string) && in_array(((string) $actual), self::$string)) ||
                (in_array(((string) $expected), self::$array) && in_array(((string) $actual), self::$array)) ||
                (in_array(((string) $expected), self::$iterable) && (in_array(((string) $actual), self::$iterable) || in_array(((string) $actual), self::$array))) ||
                (in_array(((string) $expected), self::$callable) && (in_array(((string) $actual), self::$callable) || in_array(((string) $actual), self::$array))) ||
                (in_array(((string) $expected), self::$resource) && in_array(((string) $actual), self::$resource))
            ;
        }

        return $expected == $actual;
    }
}