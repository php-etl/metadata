<?php declare(strict_types=1);

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\IterableTypeMetadataInterface;
use Kiboko\Component\Metadata\MultipleRelationMetadata;
use PhpSpec\ObjectBehavior;

final class MultipleRelationMetadataSpec extends ObjectBehavior
{
    function it_is_initializable(IterableTypeMetadataInterface $type)
    {
        $this->beConstructedWith('foo', $type);
        $this->shouldHaveType(MultipleRelationMetadata::class);
    }
}
