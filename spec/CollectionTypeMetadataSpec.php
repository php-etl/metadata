<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\CollectionTypeMetadata;
use Kiboko\Component\ETL\Metadata\IterableTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
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
        $this->type->shouldBeLike(new ClassTypeMetadata(\stdClass::class));
    }

    function it_should_have_an_inner_type()
    {
        $this->beConstructedWith(
            new ClassTypeMetadata(\stdClass::class),
            new ScalarTypeMetadata('string')
        );
        $this->inner->shouldBeLike(new ScalarTypeMetadata('string'));
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
