<?php

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Contract\Metadata\TypeMetadataInterface;
use PhpSpec\ObjectBehavior;

class ScalarTypeMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('string');
        $this->shouldHaveType(ScalarTypeMetadata::class);
        $this->shouldHaveType(TypeMetadataInterface::class);
    }

    function it_can_not_be_anonymous()
    {
        $this->beConstructedWith(null);
        $this->shouldThrow(\TypeError::class)->duringInstantiation();
    }

    function it_can_not_be_invalid_type_name()
    {
        $this->beConstructedWith('invalid');
        $this->shouldThrow(new \RuntimeException('The type "invalid" is not a built in PHP type.'))->duringInstantiation();
    }

    function it_can_be_casted_to_string()
    {
        $this->beConstructedWith('string');
        $this->__toString()->shouldBe('string');
    }
}
