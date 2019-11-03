<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ArrayEntryMetadata;
use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
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
