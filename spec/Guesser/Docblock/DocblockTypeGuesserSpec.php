<?php

namespace spec\Kiboko\Component\ETL\Metadata\Guesser\Docblock;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\ClassReferenceMetadata;
use Kiboko\Component\ETL\Metadata\CollectionTypeMetadata;
use Kiboko\Component\ETL\Metadata\Guesser;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;
use Phpactor\Docblock\DocblockFactory;
use PhpParser\ParserFactory;
use PhpSpec\ObjectBehavior;

class DocblockTypeGuesserSpec extends ObjectBehavior
{
    public function getMatchers(): array
    {
        return [
            'matchTypeMetadata' => function(iterable $subject, TypeMetadataInterface ...$expected) {
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
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());
        $this->shouldHaveType(Guesser\Docblock\DocblockTypeGuesser::class);
    }

    function it_is_discovering_one_scalar_type()
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var string */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this('var', $reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string')
            );
    }

    function it_is_discovering_one_nullable_scalar_type()
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var string|null */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this('var', $reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string'),
                new NullTypeMetadata()
            );
    }

    function it_is_discovering_multiple_scalar_types()
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var string|int */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this('var', $reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ScalarTypeMetadata('int')
            );
    }

    function it_is_discovering_mixed_types()
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var string|\stdClass|Guesser\Docblock\DocblockTypeGuesser|\PDO */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this('var', $reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ClassReferenceMetadata('stdClass'),
                new ClassReferenceMetadata('DocblockTypeGuesser', 'Kiboko\Component\ETL\Metadata\Guesser\Docblock'),
                new ClassReferenceMetadata('PDO')
            );
    }

    function it_is_discovering_array_type()
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var array */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this('var', $reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ArrayTypeMetadata()
            );
    }

    function it_is_discovering_iterable_type()
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var iterable */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this('var', $reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('iterable')
            );
    }

    function it_is_discovering_class_list_type()
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var \stdClass[] */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this('var', $reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ListTypeMetadata(
                    new ClassReferenceMetadata('stdClass')
                )
            );
    }

    function it_is_discovering_collection_type()
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var \Collection<\stdClass> */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this('var', $reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new CollectionTypeMetadata(
                    new ClassReferenceMetadata('Collection'),
                    new ClassReferenceMetadata('stdClass')
                )
            );
    }
}
