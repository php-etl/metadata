<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ScalarTypeMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final readonly class ScalarTypeMetadata implements ScalarTypeMetadataInterface, \Stringable
{
    public function __construct(private string $name)
    {
        if (!\in_array($this->name, Type::$builtInTypes)) {
            throw new \RuntimeException(strtr('The type "%type.name%" is not a built in PHP type.', ['%type.name%' => $this->name]));
        }
    }

    public static function is(TypeMetadataInterface $other): bool
    {
        return $other instanceof self;
    }

    public static function auto(string $type): self
    {
        if (\in_array($type, Type::$boolean)) {
            return self::boolean();
        }
        if (\in_array($type, Type::$integer)) {
            return self::integer();
        }
        if (\in_array($type, Type::$float)) {
            return self::float();
        }
        if (\in_array($type, Type::$numberCompatible)) {
            return self::number();
        }
        if (\in_array($type, Type::$string)) {
            return self::string();
        }
        if (\in_array($type, Type::$binary)) {
            return self::string();
        }

        throw new \RuntimeException(strtr('The type "%type.name%" is not a built in PHP type.', ['%type.name%' => $type]));
    }

    public static function boolean(): self
    {
        return new self('bool');
    }

    public static function integer(): self
    {
        return new self('int');
    }

    public static function float(): self
    {
        return new self('float');
    }

    public static function number(): self
    {
        return new self('numeric');
    }

    public static function string(): self
    {
        return new self('string');
    }

    public static function binary(): self
    {
        return new self('binary');
    }

    public static function tryBoolean(string $type): self
    {
        if (!\in_array($type, Type::$boolean)) {
            throw new \RuntimeException(strtr('The type "%type.name%" is not a built in boolean PHP type.', ['%type.name%' => $type]));
        }

        return new self('bool');
    }

    public static function tryInteger(string $type): self
    {
        if (!\in_array($type, Type::$integer)) {
            throw new \RuntimeException(strtr('The type "%type.name%" is not a built in integer PHP type.', ['%type.name%' => $type]));
        }

        return new self('int');
    }

    public static function tryFloat(string $type): self
    {
        if (!\in_array($type, Type::$float)) {
            throw new \RuntimeException(strtr('The type "%type.name%" is not a built in float PHP type.', ['%type.name%' => $type]));
        }

        return new self('float');
    }

    public static function tryNumber(string $type): self
    {
        if (!\in_array($type, Type::$numberCompatible)) {
            throw new \RuntimeException(strtr('The type "%type.name%" is not a built in number PHP type.', ['%type.name%' => $type]));
        }

        return new self('numeric');
    }

    public static function tryString(string $type): self
    {
        if (!\in_array($type, Type::$string)) {
            throw new \RuntimeException(strtr('The type "%type.name%" is not a built in string PHP type.', ['%type.name%' => $type]));
        }

        return new self('string');
    }

    public static function tryBinary(string $type): self
    {
        if (!\in_array($type, Type::$binary)) {
            throw new \RuntimeException(strtr('The type "%type.name%" is not a built in binary PHP type.', ['%type.name%' => $type]));
        }

        return new self('binary');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
