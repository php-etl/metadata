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

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
