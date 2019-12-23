<?php declare(strict_types=1);

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\VirtualUnaryRelationMetadata;
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
