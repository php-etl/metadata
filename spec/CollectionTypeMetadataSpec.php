<?php

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\ClassTypeMetadata;
use Kiboko\Component\Metadata\CollectionTypeMetadata;
use Kiboko\Component\Metadata\IterableTypeMetadataInterface;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use PhpSpec\ObjectBehavior;

class CollectionTypeMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(
            new ClassTypeMetadata(\stdClass::class),
            new ScalarTypeMetadata('string')
        );
        $this->shouldHaveType(CollectionTypeMetadata::class);
        $this->shouldHaveType(IterableTypeMetadataInterface::class);
    }

    function it_should_have_a_type()
    {
        $this->beConstructedWith(
            new ClassTypeMetadata(\stdClass::class),
            new ScalarTypeMetadata('string')
        );
        $this->getType()->shouldBeLike(new ClassTypeMetadata(\stdClass::class));
    }

    function it_should_have_an_inner_type()
    {
        $this->beConstructedWith(
            new ClassTypeMetadata(\stdClass::class),
            new ScalarTypeMetadata('string')
        );
        $this->getInner()->shouldBeLike(new ScalarTypeMetadata('string'));
    }

    function it_can_be_casted_to_string()
    {
        $this->beConstructedWith(
            new ClassTypeMetadata(\stdClass::class),
            new ScalarTypeMetadata('string')
        );
        $this->__toString()->shouldBe('stdClass<string>');
    }
}
