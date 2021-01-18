<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\Annotated;

use Kiboko\Component\Metadata\ListTypeMetadataInterface;
use Kiboko\Component\Metadata\TypeMetadataInterface;

final class ListTypeMetadata implements ListTypeMetadataInterface, AnnotatedInterface
{
    use AnnotatedTrait;

    private ListTypeMetadataInterface $decorated;

    public function __construct(ListTypeMetadataInterface $decorated, ?string $annotation = null)
    {
        $this->decorated = $decorated;
        $this->annotation = $annotation;
    }

    public function getInner(): TypeMetadataInterface
    {
        return $this->decorated->getInner();
    }

    public function __toString()
    {
        return (string) $this->decorated;
    }
}
