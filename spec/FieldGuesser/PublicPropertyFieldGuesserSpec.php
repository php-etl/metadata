<?php declare(strict_types=1);

namespace spec\Kiboko\Component\Metadata\FieldGuesser;

use Kiboko\Component\Metadata\ClassMetadataBuilder;
use Kiboko\Component\Metadata\FieldGuesser\DummyFieldGuesser;
use Kiboko\Component\Metadata\FieldGuesser\PublicPropertyFieldGuesser;
use Kiboko\Component\Metadata\FieldMetadata;
use Kiboko\Component\Metadata\MethodGuesser\DummyMethodGuesser;
use Kiboko\Component\Metadata\PropertyGuesser\ReflectionPropertyGuesser;
use Kiboko\Component\Metadata\RelationGuesser\DummyRelationGuesser;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\TypeGuesser;
use Kiboko\Contract\Metadata\FieldGuesserInterface;
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
            new TypeGuesser\Native\NativeTypeGuesser(),
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
