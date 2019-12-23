<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ClassMetadataBuilder;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\FieldGuesser\DummyFieldGuesser;
use Kiboko\Component\ETL\Metadata\FieldGuesser\PublicPropertyFieldGuesser;
use Kiboko\Component\ETL\Metadata\MethodGuesser\DummyMethodGuesser;
use Kiboko\Component\ETL\Metadata\MethodGuesser\ReflectionMethodGuesser;
use Kiboko\Component\ETL\Metadata\PropertyGuesser\DummyPropertyGuesser;
use Kiboko\Component\ETL\Metadata\PropertyGuesser\ReflectionPropertyGuesser;
use Kiboko\Component\ETL\Metadata\RelationGuesser\DummyRelationGuesser;
use Kiboko\Component\ETL\Metadata\TypeGuesser;
use Phpactor\Docblock\DocblockFactory;
use PhpParser\ParserFactory;
use PhpSpec\ObjectBehavior;

class ClassMetadataBuilderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new DummyPropertyGuesser(), new DummyMethodGuesser(), new DummyFieldGuesser(), new DummyRelationGuesser());
        $this->shouldHaveType(ClassMetadataBuilder::class);
    }

    function it_accepts_anonymous_classes()
    {
        $this->beConstructedWith(new DummyPropertyGuesser(), new DummyMethodGuesser(), new DummyFieldGuesser(), new DummyRelationGuesser());

        $object = new class {};

        $this->buildFromObject($object)->shouldReturnAnInstanceOf(ClassTypeMetadata::class);
    }

    function it_reads_properties()
    {
        $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser(
                (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
                new DocblockFactory()
            )
        );

        $this->beConstructedWith(
            new ReflectionPropertyGuesser($typeGuesser),
            new DummyMethodGuesser(),
            new DummyFieldGuesser(),
            new DummyRelationGuesser()
        );

        $object = new class {
            public $foo;
        };

        $this->buildFromObject($object)->shouldHavePropertyCount(1);
    }

    function it_detects_properties_type()
    {
        $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser(
                (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
                new DocblockFactory()
            )
        );

        $this->beConstructedWith(
            new ReflectionPropertyGuesser($typeGuesser),
            new DummyMethodGuesser(),
            new DummyFieldGuesser(),
            new DummyRelationGuesser()
        );

        $object = new class {
            /** @var \stdClass */
            public $foo;
        };

        $this->buildFromObject($object)->shouldNotHaveCompositedProperty('foo');
        $this->buildFromObject($object)->shouldHavePropertyIsInstanceOf('foo', 'stdClass');
    }

    function it_detects_properties_arrays()
    {
        $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser(
                (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
                new DocblockFactory()
            )
        );

        $this->beConstructedWith(
            new ReflectionPropertyGuesser($typeGuesser),
            new DummyMethodGuesser(),
            new DummyFieldGuesser(),
            new DummyRelationGuesser()
        );

        $object = new class {
            /** @var \stdClass[] */
            public $foo;
        };

        $this->buildFromObject($object)->shouldHaveCompositedProperty('foo');
        $this->buildFromObject($object)->shouldHaveCompositedPropertyIsInstanceOf('foo', 'stdClass');
        $this->buildFromObject($object)->shouldHavePropertyIsType('foo', 'array');
    }

    function it_reads_methods()
    {
        $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser(
                (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
                new DocblockFactory()
            )
        );

        $this->beConstructedWith(
            new DummyPropertyGuesser(),
            new ReflectionMethodGuesser($typeGuesser),
            new DummyFieldGuesser(),
            new DummyRelationGuesser()
        );

        $object = new class {
            public function foo() {}
        };

        $this->buildFromObject($object)->shouldHaveMethodCount(1);
    }

    function it_detects_methods_return_type()
    {
        $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser(
                (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
                new DocblockFactory()
            )
        );

        $this->beConstructedWith(
            new DummyPropertyGuesser(),
            new ReflectionMethodGuesser($typeGuesser),
            new DummyFieldGuesser(),
            new DummyRelationGuesser()
        );

        $object = new class {
            /** @return \stdClass */
            public function foo(){}
        };

        $this->buildFromObject($object)->shouldNotHaveCompositedMethodReturn('foo');
        $this->buildFromObject($object)->shouldHaveMethodReturnIsInstanceOf('foo', 'stdClass');
    }

    function it_detects_methods_return_arrays()
    {
        $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser(
                (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
                new DocblockFactory()
            )
        );

        $this->beConstructedWith(
            new DummyPropertyGuesser(),
            new ReflectionMethodGuesser($typeGuesser),
            new DummyFieldGuesser(),
            new DummyRelationGuesser()
        );

        $object = new class {
            /** @return \stdClass[] */
            public function foo(){}
        };

        $this->buildFromObject($object)->shouldHaveCompositedMethodReturn('foo');
        $this->buildFromObject($object)->shouldHaveCompositedMethodReturnIsInstanceOf('foo', 'stdClass');
        $this->buildFromObject($object)->shouldHaveMethodReturnIsType('foo', 'array');
    }

    function it_detects_fields_type()
    {
        $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser(
                (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
                new DocblockFactory()
            )
        );

        $this->beConstructedWith(
            new ReflectionPropertyGuesser($typeGuesser),
            new DummyMethodGuesser(),
            new PublicPropertyFieldGuesser(),
            new DummyRelationGuesser()
        );

        $object = new class {
            /** @var \stdClass */
            public $foo;
        };

        $this->buildFromObject($object)->shouldNotHaveCompositedProperty('foo');
        $this->buildFromObject($object)->shouldHavePropertyIsInstanceOf('foo', 'stdClass');
    }

    function it_detects_fields_arrays()
    {
        $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser(
                (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
                new DocblockFactory()
            )
        );

        $this->beConstructedWith(
            new ReflectionPropertyGuesser($typeGuesser),
            new DummyMethodGuesser(),
            new DummyFieldGuesser(),
            new DummyRelationGuesser()
        );

        $object = new class {
            /** @var \stdClass[] */
            public $foo;
        };

        $this->buildFromObject($object)->shouldHaveCompositedProperty('foo');
        $this->buildFromObject($object)->shouldHaveCompositedPropertyIsInstanceOf('foo', 'stdClass');
        $this->buildFromObject($object)->shouldHavePropertyIsType('foo', 'array');
    }
}

