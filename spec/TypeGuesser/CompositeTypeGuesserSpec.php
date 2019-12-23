<?php

namespace spec\Kiboko\Component\ETL\Metadata\TypeGuesser;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\ClassReferenceMetadata;
use Kiboko\Component\ETL\Metadata\CollectionTypeMetadata;
use Kiboko\Component\ETL\Metadata\TypeGuesser;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\UnionTypeMetadata;
use Phpactor\Docblock\DocblockFactory;
use PhpParser\ParserFactory;
use PhpSpec\ObjectBehavior;

class CompositeTypeGuesserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );
        $this->shouldHaveType(TypeGuesser\CompositeTypeGuesser::class);
    }

    function it_is_discovering_one_scalar_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var string */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(new ScalarTypeMetadata('string'));
    }

    function it_is_discovering_one_nullable_scalar_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var string|null */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new UnionTypeMetadata(
                    new ScalarTypeMetadata('string'),
                    new NullTypeMetadata()
                )
            );
    }

    function it_is_discovering_multiple_scalar_types()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var string|int */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new UnionTypeMetadata(
                    new ScalarTypeMetadata('string'),
                    new ScalarTypeMetadata('int')
                )
            );
    }

    function it_is_discovering_mixed_types()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var string|\stdClass|TypeGuesser\Docblock\DocblockTypeGuesser|\PDO */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new UnionTypeMetadata(
                    new ScalarTypeMetadata('string'),
                    new ClassReferenceMetadata('stdClass'),
                    new ClassReferenceMetadata('DocblockTypeGuesser', 'Kiboko\Component\ETL\Metadata\TypeGuesser\Docblock'),
                    new ClassReferenceMetadata('PDO')
                )
            );
    }

    function it_is_discovering_array_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var array */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new ArrayTypeMetadata()
            );
    }

    function it_is_discovering_iterable_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var iterable */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new ScalarTypeMetadata('iterable')
            );
    }

    function it_is_discovering_class_list_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var \stdClass[] */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new ListTypeMetadata(
                    new ClassReferenceMetadata('stdClass')
                )
            );
    }

    function it_is_discovering_collection_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var \Collection<\stdClass> */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new CollectionTypeMetadata(
                    new ClassReferenceMetadata('Collection'),
                    new ClassReferenceMetadata('stdClass')
                )
            );
    }

    function it_is_discovering_one_php74_scalar_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            public string $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new ScalarTypeMetadata('string')
            );
    }

    function it_is_discovering_one_php74_nullable_scalar_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            public ?string $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new UnionTypeMetadata(
                    new ScalarTypeMetadata('string'),
                    new NullTypeMetadata()
                )
            );
    }

    function it_is_discovering_php74_array_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            public array $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new ArrayTypeMetadata()
            );
    }

    function it_is_discovering_php74_array_type_with_docblock()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var \stdClass[] */
            public array $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new UnionTypeMetadata(
                    new ArrayTypeMetadata(),
                    new ListTypeMetadata(
                        new ClassReferenceMetadata('stdClass')
                    )
                )
            );
    }

    function it_is_discovering_php74_iterable_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            public iterable $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new ScalarTypeMetadata('iterable')
            );
    }

    function it_is_discovering_php74_iterable_type_with_docblock()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            /** @var \stdClass[] */
            public iterable $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new UnionTypeMetadata(
                    new ScalarTypeMetadata('iterable'),
                    new ListTypeMetadata(
                        new ClassReferenceMetadata('stdClass')
                    )
                )
            );
    }

    function it_is_discovering_php74_class_type()
    {
        $this->beConstructedWith(
            new TypeGuesser\Native\Php74TypeGuesser(),
            new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
        );

        $object = new class {
            public \stdClass $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldBeLike(
                new ClassReferenceMetadata('stdClass')
            );
    }
}
