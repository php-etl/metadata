<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class MethodMetadata implements NamedInterface
{
    use NamedTrait;

    /** @var ArgumentListMetadata*/
    private $arguments;
    /** @var TypeMetadataInterface */
    private $returnType;

    public function __construct(string $name, ArgumentListMetadata $argumentList, ?TypeMetadataInterface $returnType = null)
    {
        $this->name = $name;
        $this->arguments = $argumentList;
        $this->returnType = $returnType ?? new VoidTypeMetadata();
    }

    public function getArguments(): ArgumentListMetadata
    {
        return $this->arguments;
    }

    public function getReturnType(): TypeMetadataInterface
    {
        return $this->returnType;
    }
}