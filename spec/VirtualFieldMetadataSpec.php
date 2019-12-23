<?php declare(strict_types=1);

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ArgumentMetadata;
use Kiboko\Component\ETL\Metadata\ArgumentListMetadata;
use Kiboko\Component\ETL\Metadata\MethodMetadata;
use Kiboko\Component\ETL\Metadata\MixedTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\VirtualFieldMetadata;
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

        $this->getAccessor()->shouldReturnAnInstanceOf(MethodMetadata::class);
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
        $this->getMutator()->shouldReturnAnInstanceOf(MethodMetadata::class);
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
        $this->getChecker()->shouldReturnAnInstanceOf(MethodMetadata::class);
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
        $this->getRemover()->shouldReturnAnInstanceOf(MethodMetadata::class);
    }
}
