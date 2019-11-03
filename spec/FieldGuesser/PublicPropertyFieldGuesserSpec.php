<?php declare(strict_types=1);

namespace spec\Kiboko\Component\ETL\Metadata\FieldGuesser;

use Kiboko\Component\ETL\Metadata\ClassMetadataBuilder;
use Kiboko\Component\ETL\Metadata\FieldGuesser\DummyFieldGuesser;
use Kiboko\Component\ETL\Metadata\FieldMetadata;
use Kiboko\Component\ETL\Metadata\FieldGuesser\FieldGuesserInterface;
use Kiboko\Component\ETL\Metadata\FieldGuesser\PublicPropertyFieldGuesser;
use Kiboko\Component\ETL\Metadata\MethodGuesser\DummyMethodGuesser;
use Kiboko\Component\ETL\Metadata\PropertyGuesser\ReflectionPropertyGuesser;
use Kiboko\Component\ETL\Metadata\RelationGuesser\DummyRelationGuesser;
use Kiboko\Component\ETL\Metadata\TypeGuesser;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Phpactor\Docblock\DocblockFactory;
use PhpParser\ParserFactory;
use PhpSpec\ObjectBehavior;

final class PublicPropertyFieldGuesserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PublicPropertyFieldGuesser::class);
        $this->shouldHaveType(FieldGuesserInterface::class);
    }

    function it_is_discovering_properties()
    {
        $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser(
                (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
                new DocblockFactory()
            )
        );

        $metadata = (new ClassMetadataBuilder(
            new ReflectionPropertyGuesser($typeGuesser),
            new DummyMethodGuesser(),
            new DummyFieldGuesser(),
            new DummyRelationGuesser()
        ))->buildFromObject(new class {
            /** @var string */
            public $foo;
            public $foz;
            public \stdClass $object;
            protected $bar;
            private $baz;
        });

        $this->__invoke($metadata)
            ->shouldIterateLike(new \ArrayIterator([
                new FieldMetadata('foo', new ScalarTypeMetadata('string')),
            ]))
        ;
    }
}