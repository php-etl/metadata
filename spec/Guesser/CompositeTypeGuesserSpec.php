<?php

namespace spec\Kiboko\Component\ETL\Metadata\Guesser;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\CollectionTypeMetadata;
use Kiboko\Component\ETL\Metadata\Guesser;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\TypeMetadata;
use Phpactor\Docblock\DocblockFactory;
use PhpSpec\ObjectBehavior;

class CompositeTypeGuesserSpec extends ObjectBehavior
{
    public function getMatchers(): array
    {
        return [
            'matchTypeMetadata' => function(iterable $subject, TypeMetadata ...$expected) {
                foreach ($subject as $item) {
                    if (($offset = array_search($item, $expected, false)) === false) {
                        return false;
                    }

                    array_splice($expected, $offset, 1);
                }

                return count($expected) <= 0;
            }
        ];
    }

    function it_is_initializable()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );
        $this->shouldHaveType(Guesser\CompositeTypeGuesser::class);
    }

    function it_is_discovering_one_scalar_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var string */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string')
            );
    }

    function it_is_discovering_one_nullable_scalar_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var string|null */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ScalarTypeMetadata('null')
            );
    }

    function it_is_discovering_multiple_scalar_types()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var string|int */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ScalarTypeMetadata('int')
            );
    }

    function it_is_discovering_mixed_types()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var string|\stdClass|CompositeTypeGuesser|\PDO */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ClassTypeMetadata(\stdClass::class),
                new ClassTypeMetadata('CompositeTypeGuesser'),
                new ClassTypeMetadata(\PDO::class)
            );
    }

    function it_is_discovering_array_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var array */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('array')
            );
    }

    function it_is_discovering_iterable_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var iterable */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('iterable')
            );
    }

    function it_is_discovering_class_list_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var \stdClass[] */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ListTypeMetadata(
                    new ClassTypeMetadata(\stdClass::class)
                )
            );
    }

    function it_is_discovering_collection_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var \Collection<\stdClass> */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new CollectionTypeMetadata(
                    new ClassTypeMetadata('Collection'),
                    new ClassTypeMetadata(\stdClass::class)
                )
            );
    }

    function it_is_discovering_one_php74_scalar_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            public string $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string')
            );
    }

    function it_is_discovering_one_php74_nullable_scalar_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            public ?string $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ScalarTypeMetadata('null')
            );
    }

    function it_is_discovering_php74_array_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            public array $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('array')
            );
    }

    function it_is_discovering_php74_array_type_with_docblock()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var \stdClass[] */
            public array $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('array'),
                new ListTypeMetadata(
                    new ClassTypeMetadata(\stdClass::class)
                )
            );
    }

    function it_is_discovering_php74_iterable_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            public iterable $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('iterable')
            );
    }

    function it_is_discovering_php74_iterable_type_with_docblock()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            /** @var \stdClass[] */
            public iterable $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('iterable'),
                new ListTypeMetadata(
                    new ClassTypeMetadata(\stdClass::class)
                )
            );
    }

    function it_is_discovering_php74_class_type()
    {
        $this->beConstructedWith(
            new Guesser\Native\Php74TypeGuesser(),
            new Guesser\Docblock\DocblockTypeGuesser(new DocblockFactory())
        );

        $object = new class {
            public \stdClass $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ClassTypeMetadata(\stdClass::class)
            );
    }
}
