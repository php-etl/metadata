<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassReferenceMetadataInterface;
use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\CollectionTypeMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

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
    public static $binary = ['binary'];
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
    public static $void = ['void'];
    /** @internal */
    public static $static = ['static'];
    /** @internal */
    public static $self = ['self'];
    /** @internal */
    public static $builtInTypes = [
        'bool', 'boolean',
        'int', 'integer',
        'float', 'decimal', 'double',
        'numeric', 'number',
        'string', 'binary',
        'array', 'iterable',
        'object',
        'callable',
        'resource',
        'null',
    ];

    /**
     * @param UnionTypeMetadata $right
     */
    public static function isSubsetOf(UnionTypeMetadata $left, iterable $right): UnionTypeMetadata
    {
        $types = [];
        foreach ($left as $type) {
            if (self::isOneOf($type, ...$right)) {
                $types[] = $type;
            }
        }

        return new UnionTypeMetadata(...$types);
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

    public static function isCompatible(TypeMetadataInterface $left, TypeMetadataInterface $right): bool
    {
        if ($left instanceof UnionTypeMetadata) {
            return self::is($left, self::isSubsetOf($left, $right));
        }

        return self::is($left, $right);
    }

    public static function is(TypeMetadataInterface $left, TypeMetadataInterface $right): bool
    {
        if (($left instanceof ClassTypeMetadataInterface || $left instanceof ClassReferenceMetadataInterface)
            && ($right instanceof ClassTypeMetadataInterface || $right instanceof ClassReferenceMetadataInterface)
        ) {
            return ((string) $left === (string) $right) || is_a((string) $left, (string) $right, true);
        }
        if ($left instanceof ListTypeMetadata && $right instanceof ListTypeMetadata) {
            return self::is($left->getInner(), $right->getInner());
        }
        if ($left instanceof CollectionTypeMetadataInterface && $right instanceof CollectionTypeMetadataInterface) {
            return self::is($left->getType(), $right->getType())
                && (((string) $left === (string) $right) || is_a((string) $left->getInner(), (string) $right->getInner()));
        }
        if ($left instanceof ScalarTypeMetadata && $right instanceof ScalarTypeMetadata) {
            return ((string) $left) === ((string) $right)
                || (\in_array((string) $left, self::$boolean) && \in_array((string) $right, self::$boolean))
                || (\in_array((string) $left, self::$integer) && \in_array((string) $right, self::$integer))
                || (\in_array((string) $left, self::$float) && \in_array((string) $right, self::$float))
                || (\in_array((string) $left, self::$numberCompatible) && \in_array((string) $right, self::$numberMeta))
                || (\in_array((string) $left, self::$string) && \in_array((string) $right, self::$string))
                || (\in_array((string) $left, self::$binary) && \in_array((string) $right, self::$binary))
                || (\in_array((string) $left, self::$array) && \in_array((string) $right, self::$array))
                || (\in_array((string) $left, self::$iterable) && (\in_array((string) $right, self::$iterable) || \in_array((string) $left, self::$array)))
                || (\in_array((string) $left, self::$callable) && (\in_array((string) $right, self::$callable) || \in_array((string) $left, self::$array)))
                || (\in_array((string) $left, self::$resource) && \in_array((string) $right, self::$resource))
            ;
        }

        return $left == $right;
    }
}
