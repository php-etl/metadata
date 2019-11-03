<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

final class MethodMetadata implements NamedInterface
{
    use NamedTrait;

    /** @var ArgumentListMetadata*/
    private $arguments;
    /** @var TypeMetadataInterface[] */
    private $returnTypes;

    public function __construct(string $name, ArgumentListMetadata $argumentList, TypeMetadataInterface ...$returnTypes)
    {
        $this->name = $name;
        $this->arguments = $argumentList;
        $this->returnTypes = $returnTypes;
    }

    public function getArguments(): ArgumentListMetadata
    {
        return $this->arguments;
    }

    /** @return iterable<TypeMetadataInterface> */
    public function getReturnTypes(): iterable
    {
        return $this->returnTypes;
    }
}