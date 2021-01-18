<?php declare(strict_types=1);

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\ClassTypeMetadata;
use Kiboko\Component\Metadata\CollectionTypeMetadata;
use Kiboko\Component\Metadata\FieldMetadata;
use Kiboko\Component\Metadata\ListTypeMetadata;
use Kiboko\Component\Metadata\MixedTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\UnionTypeMetadata;
use PhpSpec\ObjectBehavior;

final class FieldMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('foo', new MixedTypeMetadata());
        $this->shouldHaveType(FieldMetadata::class);

        $this->getName()->shouldReturn('foo');
    }

    function it_is_accepting_one_scalar_type()
    {
        $this->beConstructedWith('foo', new ScalarTypeMetadata('string'));

        $this->getType()->shouldReturnAnInstanceOf(ScalarTypeMetadata::class);
    }

    function it_is_accepting_one_class_type()
    {
        $this->beConstructedWith('foo', new ClassTypeMetadata('stdClass'));

        $this->getType()->shouldReturnAnInstanceOf(ClassTypeMetadata::class);
    }

    function it_is_accepting_one_collection_type()
    {
        $this->beConstructedWith(
            'foo',
            new CollectionTypeMetadata(
                new ClassTypeMetadata('stdClass'),
                new ScalarTypeMetadata('string')
            )
        );

        $this->getType()->shouldReturnAnInstanceOf(CollectionTypeMetadata::class);
    }

    function it_is_accepting_one_list_type()
    {
        $this->beConstructedWith(
            'foo',
            new ListTypeMetadata(
                new ScalarTypeMetadata('string')
            )
        );

        $this->getType()->shouldReturnAnInstanceOf(ListTypeMetadata::class);
    }

    function it_is_accepting_multiple_types()
    {
        $this->beConstructedWith(
            'foo',
            new UnionTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ClassTypeMetadata('stdClass'),
                new CollectionTypeMetadata(
                    new ClassTypeMetadata('stdClass'),
                    new ScalarTypeMetadata('string')
                ),
                new ListTypeMetadata(
                    new ScalarTypeMetadata('string')
                )
            )
        );

        $this->getType()->shouldReturnAnInstanceOf(UnionTypeMetadata::class);
    }
}
