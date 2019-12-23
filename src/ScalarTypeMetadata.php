<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class ScalarTypeMetadata implements TypeMetadataInterface
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        if (!in_array($name, Type::$builtInTypes)) {
            throw new \RuntimeException(strtr(
                'The type "%type.name%" is not a built in PHP type.',
                [
                    '%type.name%' => $name,
                ]
            ));
        }

        $this->name = $name;
    }

    public static function is(TypeMetadataInterface $other): bool
    {
        return $other instanceof self;
    }

    public function __toString()
    {
        return $this->name;
    }
}