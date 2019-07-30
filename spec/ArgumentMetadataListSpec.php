<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ArgumentMetadata;
use Kiboko\Component\ETL\Metadata\ArgumentMetadataList;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use PhpSpec\ObjectBehavior;

class ArgumentMetadataListSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArgumentMetadataList::class);
        $this->shouldHaveType(\IteratorAggregate::class);
    }

    function it_can_initializes_list()
    {
        $this->beConstructedWith(
            new ArgumentMetadata('foo', new ScalarTypeMetadata('string')),
            new ArgumentMetadata('bar', new ScalarTypeMetadata('int'))
        );

        $this->arguments->shouldHaveCount(2);
        $this->arguments->shouldIterateLike(new \ArrayIterator([
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
