<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ArgumentMetadataInterface;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\VariadicArgumentMetadata;
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

        $this->getTypes()->shouldHaveCount(1);
        $this->getTypes()->shouldIterateLike(new \ArrayIterator([
            new ScalarTypeMetadata('string'),
        ]));
    }

    function it_has_several_types()
    {
        $this->beConstructedWith('foo', new ScalarTypeMetadata('string'), new ScalarTypeMetadata('int'), new NullTypeMetadata());

        $this->getTypes()->shouldHaveCount(3);
        $this->getTypes()->shouldIterateLike(new \ArrayIterator([
            new ScalarTypeMetadata('string'),
            new ScalarTypeMetadata('int'),
            new NullTypeMetadata(),
        ]));
    }
}
