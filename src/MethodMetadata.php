<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ArgumentListMetadataInterface;
use Kiboko\Contract\Metadata\MethodMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class MethodMetadata implements MethodMetadataInterface
{
    use NamedTrait;

    private ArgumentListMetadataInterface $arguments;
    private TypeMetadataInterface $returnType;

    public function __construct(string $name, ArgumentListMetadataInterface $argumentList, ?TypeMetadataInterface $returnType = null)
    {
        $this->name = $name;
        $this->arguments = $argumentList;
        $this->returnType = $returnType ?? new VoidTypeMetadata();
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
