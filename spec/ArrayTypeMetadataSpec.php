<?php

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\ArrayEntryMetadata;
use Kiboko\Component\Metadata\ArrayTypeMetadata;
use Kiboko\Contract\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use PhpSpec\ObjectBehavior;

class ArrayTypeMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArrayTypeMetadata::class);
        $this->shouldHaveType(\IteratorAggregate::class);
        $this->shouldHaveType(CompositeTypeMetadataInterface::class);
    }

    function it_can_iterate()
    {
        $this->beConstructedWith(
            new ArrayEntryMetadata('foo', new ScalarTypeMetadata('string')),
            new ArrayEntryMetadata('bar', new ScalarTypeMetadata('int'))
        );

        $this->getIterator()->shouldBeAnInstanceOf(\Traversable::class);

        $this->getIterator()->shouldHaveCount(2);
        $this->getIterator()->shouldIterateLike(new \ArrayIterator([
            new ArrayEntryMetadata('foo', new ScalarTypeMetadata('string')),
            new ArrayEntryMetadata('bar', new ScalarTypeMetadata('int')),
        ]));
    }

    function it_can_be_casted_to_string()
    {
        $this->__toString()->shouldBe('array');
    }
}
