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

        $this->getName()->shouldBeEqualTo('stdClass');
        $this->getNamespace()->shouldBeNull();
    }

    function it_can_not_be_anonymous()
    {
        $this->beConstructedWith(null);
        $this->shouldThrow(\TypeError::class)->duringInstantiation();
    }

    function it_can_accept_namespaces()
    {
        $this->beConstructedWith('Amet', 'Lorem\\Ipsum\\Dolor\\Sit');

        $this->getName()->shouldBeEqualTo('Amet');
        $this->getNamespace()->shouldBeEqualTo('Lorem\\Ipsum\\Dolor\\Sit');
    }

    function it_can_be_casted_to_string()
    {
        $this->beConstructedWith('Amet', 'Lorem\\Ipsum\\Dolor\\Sit');

        $this->__toString()->shouldBe('Lorem\\Ipsum\\Dolor\\Sit\\Amet');
    }

    function it_should_throw_an_exception_on_anchored_class_name()
    {
        $this->beConstructedWith('\\Amet');
        $this->shouldThrow(new \RuntimeException('Class names should not contain root namespace anchoring backslash or namespace.'))->duringInstantiation();
    }

    function it_should_throw_an_exception_on_namespaced_class_name()
    {
        $this->beConstructedWith('Lorem\\Ipsum\\Dolor\\Sit\\Amet');
        $this->shouldThrow(new \RuntimeException('Class names should not contain root namespace anchoring backslash or namespace.'))->duringInstantiation();
    }

    function it_should_throw_an_exception_on_anchored_namespace()
    {
        $this->beConstructedWith('Amet', '\\Lorem\\Ipsum\\Dolor\\Sit');
        $this->shouldThrow(new \RuntimeException('Namespace should not contain root namespace anchoring backslash.'))->duringInstantiation();
    }
}
