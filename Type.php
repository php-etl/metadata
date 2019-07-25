<?php

namespace Kiboko\Component\ETL\Metadata;

class Type
{
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
        return $expected == $actual;
    }
}