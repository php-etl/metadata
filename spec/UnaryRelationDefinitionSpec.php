<?php declare(strict_types=1);

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\CompositeTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\UnaryRelationDefinition;
use PhpSpec\ObjectBehavior;

final class UnaryRelationDefinitionSpec extends ObjectBehavior
{
    function it_is_initializable(CompositeTypeMetadataInterface $type)
    {
        $this->beConstructedWith('foo', $type);
        $this->shouldHaveType(UnaryRelationDefinition::class);
    }

    function it_is_named(CompositeTypeMetadataInterface $type)
    {
        $this->beConstructedWith('foo', $type);
        $this->name->shouldBeEqualTo('foo');
    }
}
