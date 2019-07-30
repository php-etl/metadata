<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\NullTypeMetadata;
use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;
use PhpSpec\ObjectBehavior;

class NullTypeMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NullTypeMetadata::class);
        $this->shouldHaveType(TypeMetadataInterface::class);
    }

    function it_can_be_casted_to_string()
    {
        $this->__toString()->shouldBe('null');
    }
}
