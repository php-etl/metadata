<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\CompositeTypeMetadataInterface;
use PhpSpec\ObjectBehavior;

class ClassTypeMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(\stdClass::class);
        $this->shouldHaveType(ClassTypeMetadata::class);
        $this->shouldHaveType(CompositeTypeMetadataInterface::class);

        $this->getName()->shouldReturn('stdClass');
        $this->getNamespace()->shouldBeNull();
        $this->getMethods()->shouldHaveCount(0);
        $this->getProperties()->shouldHaveCount(0);
        $this->getFields()->shouldHaveCount(0);
        $this->getRelations()->shouldHaveCount(0);
    }

    function it_can_be_anonymous()
    {
        $this->beConstructedWith(null);

        $this->getName()->shouldReturn(null);
        $this->getNamespace()->shouldReturn(null);
        $this->getMethods()->shouldHaveCount(0);
        $this->getProperties()->shouldHaveCount(0);
        $this->getFields()->shouldHaveCount(0);
        $this->getRelations()->shouldHaveCount(0);
    }

    function it_can_accept_namespaces()
    {
        $this->beConstructedWith('Amet', 'Lorem\\Ipsum\\Dolor\\Sit');

        $this->getName()->shouldReturn('Amet');
        $this->getNamespace()->shouldReturn('Lorem\\Ipsum\\Dolor\\Sit');
        $this->getMethods()->shouldHaveCount(0);
        $this->getProperties()->shouldHaveCount(0);
        $this->getFields()->shouldHaveCount(0);
        $this->getRelations()->shouldHaveCount(0);
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
