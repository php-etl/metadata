<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ArgumentMetadata;
use Kiboko\Component\ETL\Metadata\ArgumentMetadataInterface;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\UnionTypeMetadata;
use PhpSpec\ObjectBehavior;

class ArgumentMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('foo', new ScalarTypeMetadata('string'));
        $this->shouldHaveType(ArgumentMetadata::class);
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

    function it_has_several_types()
    {
        $this->beConstructedWith('foo', new UnionTypeMetadata(new ScalarTypeMetadata('string'), new ScalarTypeMetadata('int'), new NullTypeMetadata()));

        $this->getType()->shouldHaveCount(3);
        $this->getType()->shouldIterateLike(new \ArrayIterator([
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('int'),
            new NullTypeMetadata(),
        ]));
    }
}
