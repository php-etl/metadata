<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use PhpSpec\ObjectBehavior;

class ClassTypeMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(\stdClass::class);
        $this->shouldHaveType(ClassTypeMetadata::class);

        $this->name->shouldBeEqualTo('stdClass');
        $this->methods->shouldHaveCount(0);
        $this->properties->shouldHaveCount(0);
        $this->namespace->shouldBeNull();
    }
}
