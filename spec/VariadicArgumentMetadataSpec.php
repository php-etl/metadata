<?php

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\NullTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\UnionTypeMetadata;
use Kiboko\Component\Metadata\VariadicArgumentMetadata;
use Kiboko\Contract\Metadata\ArgumentMetadataInterface;
use PhpSpec\ObjectBehavior;

class VariadicArgumentMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('foo', new ScalarTypeMetadata('string'));
        $this->shouldHaveType(VariadicArgumentMetadata::class);
        $this->shouldHaveType(ArgumentMetadataInterface::class);
    }

    function it_has_a_name()
    {
        $this->beConstructedWith('foo', new ScalarTypeMetadata('string'));

        $this->getName()->shouldReturn('foo');
    }

    function it_has_one_type()
    {
        $this->beConstructedWith('foo', new ScalarTypeMetadata('string'));

        $this->getType()->shouldBeLike(new ScalarTypeMetadata('string'));
    }

    function it_has_union_type()
    {
        $this->beConstructedWith(
            'foo',
            new UnionTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ScalarTypeMetadata('int'),
                new NullTypeMetadata()
            )
        );

        $this->getType()->shouldBeLike(
            new UnionTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ScalarTypeMetadata('int'),
                new NullTypeMetadata()
            )
        );
    }
}
