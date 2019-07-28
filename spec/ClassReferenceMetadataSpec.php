<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ClassReferenceMetadata;
use PhpSpec\ObjectBehavior;

class ClassReferenceMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(\stdClass::class);
        $this->shouldHaveType(ClassReferenceMetadata::class);

        $this->name->shouldBeEqualTo('stdClass');
        $this->namespace->shouldBeNull();
    }
}
