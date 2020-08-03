<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\Annotated;

use Kiboko\Component\ETL\Metadata\ArgumentMetadataInterface;
use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;

final class ArgumentMetadata implements ArgumentMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    private ArgumentMetadataInterface $decorated;

    public function __construct(ArgumentMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->decorated = $decorated;
        $this->annotation = $annotation;
    }

    public function getName(): string
    {
        return $this->decorated->getName();
    }

    public function getType(): TypeMetadataInterface
    {
        return $this->decorated->getType();
    }
}