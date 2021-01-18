<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

/**
 * @property string $name
 * @property Type[] $types
 */
interface FieldMetadataInterface extends NamedInterface, TypedInterface
{
}
