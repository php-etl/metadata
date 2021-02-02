<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Contract\Metadata\AnnotatedInterface;
use Kiboko\Contract\Metadata\ListTypeMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class ListTypeMetadata implements ListTypeMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    public function __construct(private ListTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->annotation = $annotation;
    }

    public function getInner(): TypeMetadataInterface
    {
        return $this->decorated->getInner();
    }

    public function __toString(): string
    {
        return (string) $this->decorated;
    }
}
