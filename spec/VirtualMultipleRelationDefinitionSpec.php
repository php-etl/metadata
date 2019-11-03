<?php declare(strict_types=1);

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\IterableTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\VirtualMultipleRelationDefinition;
use PhpSpec\ObjectBehavior;

final class VirtualMultipleRelationDefinitionSpec extends ObjectBehavior
{
    function it_is_initializable(IterableTypeMetadataInterface $type)
    {
        $this->beConstructedWith(
            'foo',
            null,
            null,
            null,
            null,
            null,
            null,
            $type
        );
        $this->shouldHaveType(VirtualMultipleRelationDefinition::class);
    }
}
