<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ArgumentListMetadataInterface;
use Kiboko\Contract\Metadata\MethodMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

/**
 * @template Subject of object
 *
 * @implements MethodMetadataInterface<Subject>
 */
final class MethodMetadata implements MethodMetadataInterface
{
    use NamedTrait;

    public function __construct(string $name, private readonly ArgumentListMetadataInterface $arguments, private readonly TypeMetadataInterface $returnType = new VoidTypeMetadata())
    {
        $this->name = $name;
    }

    public function getArguments(): ArgumentListMetadataInterface
    {
        return $this->arguments;
    }

    public function getReturnType(): TypeMetadataInterface
    {
        return $this->returnType;
    }
}
