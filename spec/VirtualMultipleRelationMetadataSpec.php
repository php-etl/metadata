<?php declare(strict_types=1);

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\IterableTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\VirtualMultipleRelationMetadata;
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
