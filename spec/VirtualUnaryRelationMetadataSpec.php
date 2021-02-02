<?php declare(strict_types=1);

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\VirtualUnaryRelationMetadata;
use Kiboko\Contract\Metadata\CompositeTypeMetadataInterface;
use PhpSpec\ObjectBehavior;

final class VirtualUnaryRelationMetadataSpec extends ObjectBehavior
{
    function it_is_initializable(CompositeTypeMetadataInterface $type)
    {
        $this->beConstructedWith(
            'foo',
            $type,
            null,
            null,
            null,
            null
        );
        $this->shouldHaveType(VirtualUnaryRelationMetadata::class);
    }
}
