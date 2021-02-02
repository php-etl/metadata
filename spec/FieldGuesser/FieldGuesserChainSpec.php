<?php declare(strict_types=1);

namespace spec\Kiboko\Component\Metadata\FieldGuesser;

use Kiboko\Component\Metadata\ClassTypeMetadata;
use Kiboko\Component\Metadata\FieldGuesser\FieldGuesserChain;
use Kiboko\Contract\Metadata\FieldGuesserInterface;
use PhpSpec\ObjectBehavior;

final class FieldGuesserChainSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FieldGuesserChain::class);
        $this->shouldHaveType(FieldGuesserInterface::class);
    }

    function it_is_calling_inner_guessers(
        FieldGuesserInterface $guesser1,
        FieldGuesserInterface $guesser2
    ) {
        $metadata = new ClassTypeMetadata(\stdClass::class);

        $guesser1->__invoke($metadata)
            ->shouldBeCalledOnce()
            ->willReturn(new \EmptyIterator())
        ;
        $guesser2->__invoke($metadata)
            ->shouldBeCalledOnce()
            ->willReturn(new \EmptyIterator())
        ;

        $this->beConstructedWith($guesser1, $guesser2);

        $this->__invoke($metadata)
            ->shouldIterateAs(new \EmptyIterator());
    }
}
