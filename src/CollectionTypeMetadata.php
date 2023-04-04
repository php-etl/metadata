<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassMetadataInterface;
use Kiboko\Contract\Metadata\CollectionTypeMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

/**
 * @template Subject of object
 *
 * @implements CollectionTypeMetadataInterface<Subject>
 *
 * @use ClassPropertiesTrait<Subject>
 * @use ClassMethodsTrait<Subject>
 * @use ClassFieldsTrait<Subject>
 * @use ClassRelationsTrait<Subject>
 */
final class CollectionTypeMetadata implements CollectionTypeMetadataInterface, \Stringable
{
    use ClassPropertiesTrait;
    use ClassMethodsTrait;
    use ClassFieldsTrait;
    use ClassRelationsTrait;

    /**
     * @param ClassMetadataInterface<Subject> $type
     */
    public function __construct(
        private readonly ClassMetadataInterface $type,
        private readonly TypeMetadataInterface $inner
    ) {
    }

    public function getNamespace(): ?string
    {
        return $this->type->getNamespace();
    }

    public function getName(): ?string
    {
        return $this->type->getName();
    }

    public function __toString(): string
    {
        return sprintf('%s<%s>', (string) $this->type, (string) $this->inner);
    }

    public function getType(): ClassMetadataInterface
    {
        return $this->type;
    }

    public function getInner(): TypeMetadataInterface
    {
        return $this->inner;
    }
}
