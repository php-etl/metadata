<?php

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\ArgumentMetadata;
use Kiboko\Component\Metadata\ArgumentListMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use PhpSpec\ObjectBehavior;

class ArgumentListMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArgumentListMetadata::class);
        $this->shouldHaveType(\IteratorAggregate::class);
    }

    function it_can_initializes_list()
    {
        $this->beConstructedWith(
            new ArgumentMetadata('foo', new ScalarTypeMetadata('string')),
            new ArgumentMetadata('bar', new ScalarTypeMetadata('int'))
        );

        $this->shouldHaveCount(2);
        $this->shouldIterateLike(new \ArrayIterator([
            new ArgumentMetadata('foo', new ScalarTypeMetadata('string')),
            new ArgumentMetadata('bar', new ScalarTypeMetadata('int')),
        ]));
    }

    function it_can_iterate()
    {
        $this->beConstructedWith(
            new ArgumentMetadata('foo', new ScalarTypeMetadata('string')),
            new ArgumentMetadata('bar', new ScalarTypeMetadata('int'))
        );

        $this->getIterator()->shouldBeAnInstanceOf(\Traversable::class);

        $this->getIterator()->shouldHaveCount(2);
        $this->getIterator()->shouldIterateLike(new \ArrayIterator([
            new ArgumentMetadata('foo', new ScalarTypeMetadata('string')),
            new ArgumentMetadata('bar', new ScalarTypeMetadata('int')),
        ]));
    }
}
