<?php declare(strict_types=1);

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Component\Metadata\UnaryRelationMetadata;
use PhpSpec\ObjectBehavior;

final class UnaryRelationMetadataSpec extends ObjectBehavior
{
    function it_is_initializable(CompositeTypeMetadataInterface $type)
    {
        $this->beConstructedWith('foo', $type);
        $this->shouldHaveType(UnaryRelationMetadata::class);
    }

    function it_is_named(CompositeTypeMetadataInterface $type)
    {
        $this->beConstructedWith('foo', $type);
        $this->getName()->shouldReturn('foo');
    }
}
