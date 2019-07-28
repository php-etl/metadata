<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ClassMetadata;
use PhpSpec\ObjectBehavior;

class ClassMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(\stdClass::class);
        $this->shouldHaveType(ClassMetadata::class);

        $this->name->shouldBeEqualTo('stdClass');
        $this->methods->shouldHaveCount(0);
        $this->properties->shouldHaveCount(0);
        $this->namespace->shouldBeNull();
    }
}
