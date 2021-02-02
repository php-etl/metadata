<?php

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\ListTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Contract\Metadata\IterableTypeMetadataInterface;
use PhpSpec\ObjectBehavior;

class ListTypeMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new ScalarTypeMetadata('string'));
        $this->shouldHaveType(ListTypeMetadata::class);
        $this->shouldHaveType(IterableTypeMetadataInterface::class);
    }

    function it_can_be_casted_to_string()
    {
        $this->beConstructedWith(new ScalarTypeMetadata('string'));
        $this->__toString()->shouldBe('string[]');
    }
}
