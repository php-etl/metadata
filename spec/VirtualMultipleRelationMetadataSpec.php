<?php declare(strict_types=1);

namespace spec\Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\VirtualMultipleRelationMetadata;
use Kiboko\Contract\Metadata\IterableTypeMetadataInterface;
use PhpSpec\ObjectBehavior;

final class VirtualMultipleRelationMetadataSpec extends ObjectBehavior
{
    function it_is_initializable(IterableTypeMetadataInterface $type)
    {
        $this->beConstructedWith(
            'foo',
            $type,
            null,
            null,
            null,
            null,
            null,
            null
        );
        $this->shouldHaveType(VirtualMultipleRelationMetadata::class);
    }
}
