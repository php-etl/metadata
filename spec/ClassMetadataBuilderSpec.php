<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\ClassMetadataBuilder;
use Kiboko\Component\ETL\Metadata\ClassReferenceMetadata;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\CollectionTypeMetadata;
use Kiboko\Component\ETL\Metadata\FieldGuesser\DummyFieldGuesser;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\MethodGuesser\DummyMethodGuesser;
use Kiboko\Component\ETL\Metadata\MethodGuesser\ReflectionMethodGuesser;
use Kiboko\Component\ETL\Metadata\PropertyGuesser\DummyPropertyGuesser;
use Kiboko\Component\ETL\Metadata\PropertyGuesser\ReflectionPropertyGuesser;
use Kiboko\Component\ETL\Metadata\RelationGuesser\DummyRelationGuesser;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\TypeGuesser;
use Phpactor\Docblock\DocblockFactory;
use PhpParser\ParserFactory;
use PhpSpec\ObjectBehavior;

class ClassMetadataBuilderSpec extends ObjectBehavior
{
    public function getMatchers(): array
    {
        return [
            'havePropertyCount' => function (ClassTypeMetadata $subject) {
                return count($subject->getProperties());
            },
            'haveCompositedPropertyIsInstanceOf' => function (ClassTypeMetadata $subject, string $property, string $class) {
                foreach ($subject->getProperty($property)->getTypes() as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata &&
                        ($typeDeclaration->getInner() instanceof ClassTypeMetadata || $typeDeclaration->getInner() instanceof ClassReferenceMetadata) &&
                        is_a((string) $typeDeclaration->getInner(), $class, true)
                    ) {
                        return true;
                    }

                    if ($typeDeclaration instanceof CollectionTypeMetadata &&
                        ($typeDeclaration->getType() instanceof ClassTypeMetadata || $typeDeclaration->getType() instanceof ClassReferenceMetadata) &&
                        is_a((string) $typeDeclaration->getType(), $class, true)
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveCompositedPropertyIsType' => function (ClassTypeMetadata $subject, string $property, string $type) {
                foreach ($subject->getProperty($property)->getTypes() as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata &&
                        $typeDeclaration->getInner() instanceof ScalarTypeMetadata &&
                        is_a($typeDeclaration->getInner()->name, $type, true)
                    ) {
                        return true;
                    }

                    if ($typeDeclaration instanceof CollectionTypeMetadata &&
                        $typeDeclaration->getType() instanceof ScalarTypeMetadata &&
                        is_a($typeDeclaration->getType()->name, $type, true)
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveCompositedProperty' => function (ClassTypeMetadata $subject, string $property) {
                foreach ($subject->getProperty($property)->getTypes() as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata || $typeDeclaration instanceof CollectionTypeMetadata) {
                        return true;
                    }
                }

                return false;
            },
            'havePropertyIsInstanceOf' => function (ClassTypeMetadata $subject, string $property, string $class) {
                foreach ($subject->getProperty($property)->getTypes() as $typeDeclaration) {
                    if (($typeDeclaration instanceof ClassTypeMetadata && is_a((string) $typeDeclaration, $class, true)) ||
                        ($typeDeclaration instanceof ClassReferenceMetadata && is_a((string) $typeDeclaration, $class, true)) ||
                        ($typeDeclaration instanceof CollectionTypeMetadata && is_a((string) $typeDeclaration->getType(), $class, true))
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'havePropertyIsType' => function (ClassTypeMetadata $subject, string $property, string $type) {
                foreach ($subject->getProperty($property)->getTypes() as $typeDeclaration) {
                    if (($typeDeclaration instanceof ClassTypeMetadata && is_a((string) $typeDeclaration, $type, true)) ||
                        ($typeDeclaration instanceof ClassReferenceMetadata && is_a((string) $typeDeclaration, $type, true)) ||
                        ($typeDeclaration instanceof CollectionTypeMetadata && is_a((string) $typeDeclaration->getType(), $type, true)) ||
                        ($typeDeclaration instanceof ListTypeMetadata && in_array($type, ['array', 'iterable'])) ||
                        ($typeDeclaration instanceof ArrayTypeMetadata && in_array($type, ['array']))
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveMethodCount' => function (ClassTypeMetadata $subject) {
                return count($subject->getMethods());
            },
            'haveCompositedMethodReturnIsInstanceOf' => function (ClassTypeMetadata $subject, string $method, string $class) {
                foreach ($subject->getMethod($method)->getReturnTypes() as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata &&
                        ($typeDeclaration->getInner() instanceof ClassTypeMetadata || $typeDeclaration->getInner() instanceof ClassReferenceMetadata) &&
                        is_a((string) $typeDeclaration->getInner(), $class, true)
                    ) {
                        return true;
                    }

                    if ($typeDeclaration instanceof CollectionTypeMetadata &&
                        ($typeDeclaration->getType() instanceof ClassTypeMetadata || $typeDeclaration->getType() instanceof ClassReferenceMetadata) &&
                        is_a((string) $typeDeclaration->getType(), $class, true)
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveCompositedMethodReturnIsType' => function (ClassTypeMetadata $subject, string $method, string $type) {
                foreach ($subject->getMethod($method)->getReturnTypes() as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata &&
                        $typeDeclaration->getInner() instanceof ScalarTypeMetadata &&
                        is_a((string) $typeDeclaration->getInner(), $type, true)
                    ) {
                        return true;
                    }

                    if ($typeDeclaration instanceof CollectionTypeMetadata &&
                        $typeDeclaration->getType() instanceof ScalarTypeMetadata &&
                        is_a((string) $typeDeclaration->getType(), $type, true)
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveCompositedMethodReturn' => function (ClassTypeMetadata $subject, string $method) {
                foreach ($subject->getMethod($method)->getReturnTypes() as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata || $typeDeclaration instanceof CollectionTypeMetadata) {
                        return true;
                    }
                }

                return false;
            },
            'haveMethodReturnIsInstanceOf' => function (ClassTypeMetadata $subject, string $method, string $class) {
                foreach ($subject->getMethod($method)->getReturnTypes() as $typeDeclaration) {
                    if (($typeDeclaration instanceof ClassTypeMetadata && is_a((string) $typeDeclaration, $class, true)) ||
                        ($typeDeclaration instanceof ClassReferenceMetadata && is_a((string) $typeDeclaration, $class, true)) ||
                        ($typeDeclaration instanceof CollectionTypeMetadata && is_a((string) $typeDeclaration->getType(), $class, true))
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveMethodReturnIsType' => function (ClassTypeMetadata $subject, string $method, string $type) {
                foreach ($subject->getMethod($method)->getReturnTypes() as $typeDeclaration) {
                    if (($typeDeclaration instanceof ClassTypeMetadata && is_a((string) $typeDeclaration, $type, true)) ||
                        ($typeDeclaration instanceof ClassReferenceMetadata && is_a((string) $typeDeclaration, $type, true)) ||
                        ($typeDeclaration instanceof CollectionTypeMetadata && is_a((string) $typeDeclaration->getType(), $type, true)) ||
                        ($typeDeclaration instanceof ListTypeMetadata && in_array($type, ['array', 'iterable'])) ||
                        ($typeDeclaration instanceof ArrayTypeMetadata && in_array($type, ['array']))
                    ) {
                        return true;
                    }
                }

                return false;
            },
        ];
    }

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
}
