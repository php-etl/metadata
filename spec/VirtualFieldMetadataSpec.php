<?php declare(strict_types=1);

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\ArgumentMetadata;
use Kiboko\Component\Metadata\ArgumentListMetadata;
use Kiboko\Component\Metadata\MethodMetadata;
use Kiboko\Component\Metadata\MethodMetadataInterface;
use Kiboko\Component\Metadata\MixedTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\VirtualFieldMetadata;
use PhpSpec\ObjectBehavior;

final class VirtualFieldMetadataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('foo', new MixedTypeMetadata());
        $this->shouldHaveType(VirtualFieldMetadata::class);

        $this->getName()->shouldReturn('foo');
        $this->getAccessor()->shouldReturn(null);
        $this->getMutator()->shouldReturn(null);
        $this->getChecker()->shouldReturn(null);
        $this->getRemover()->shouldReturn(null);
    }

    function it_is_using_an_accessor()
    {
        $this->beConstructedWith(
            'foo',
            new MixedTypeMetadata(),
            new MethodMetadata(
                'getFoo',
                new ArgumentListMetadata(),
                new ScalarTypeMetadata('string')
            )
        );

        $this->getAccessor()->shouldReturnAnInstanceOf(MethodMetadataInterface::class);
        $this->getMutator()->shouldReturn(null);
        $this->getChecker()->shouldReturn(null);
        $this->getRemover()->shouldReturn(null);
    }

    function it_is_using_a_mutator()
    {
        $this->beConstructedWith(
            'foo',
            new MixedTypeMetadata(),
            null,
            new MethodMetadata(
                'setFoo',
                new ArgumentListMetadata(
                    new ArgumentMetadata('foo', new ScalarTypeMetadata('string'))
                )
            )
        );

        $this->getAccessor()->shouldReturn(null);
        $this->getMutator()->shouldReturnAnInstanceOf(MethodMetadataInterface::class);
        $this->getChecker()->shouldReturn(null);
        $this->getRemover()->shouldReturn(null);
    }

    function it_is_using_a_checker()
    {
        $this->beConstructedWith(
            'foo',
            new MixedTypeMetadata(),
            null,
            null,
            new MethodMetadata(
                'hasFoo',
                new ArgumentListMetadata(),
                new ScalarTypeMetadata('bool')
            )
        );

        $this->getAccessor()->shouldReturn(null);
        $this->getMutator()->shouldReturn(null);
        $this->getChecker()->shouldReturnAnInstanceOf(MethodMetadataInterface::class);
        $this->getRemover()->shouldReturn(null);
    }

    function it_is_using_a_remover()
    {
        $this->beConstructedWith(
            'foo',
            new MixedTypeMetadata(),
            null,
            null,
            null,
            new MethodMetadata(
                'unsetFoo',
                new ArgumentListMetadata()
            )
        );

        $this->getAccessor()->shouldReturn(null);
        $this->getMutator()->shouldReturn(null);
        $this->getChecker()->shouldReturn(null);
        $this->getRemover()->shouldReturnAnInstanceOf(MethodMetadataInterface::class);
    }
}
