<?php

namespace spec\Kiboko\Component\Metadata\TypeGuesser\Docblock;

use Kiboko\Component\Metadata\ArrayTypeMetadata;
use Kiboko\Component\Metadata\ClassReferenceMetadata;
use Kiboko\Component\Metadata\CollectionTypeMetadata;
use Kiboko\Component\Metadata\TypeGuesser;
use Kiboko\Component\Metadata\ListTypeMetadata;
use Kiboko\Component\Metadata\NullTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Contract\Metadata\TypeMetadataInterface;
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
        $this->shouldHaveType(TypeGuesser\Docblock\DocblockTypeGuesser::class);
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
            /** @var string|\stdClass|TypeGuesser\Docblock\DocblockTypeGuesser|\PDO */
            public $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this('var', $reflection, $reflection->getProperty('foo'))
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string'),
                new ClassReferenceMetadata('stdClass'),
                new ClassReferenceMetadata('DocblockTypeGuesser', 'Kiboko\Component\Metadata\TypeGuesser\Docblock'),
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

    function it_is_failing_at_finding_class_file_name(\ReflectionClass $reflection, \ReflectionProperty $property)
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var Inexistent */
            public $foo;
        };

        $property->beConstructedWith([$object, 'foo']);
        $property->getName()->willReturn('foo');
        $property->getDocComment()->willReturn('/** @var Inexistent */');

        $reflection->beConstructedWith([$object]);
        $reflection->getShortName()->willReturn(get_class($object));
        $reflection->isAnonymous()->willReturn(true);
        $reflection->getFileName()->willReturn(false);

        $this('var', $reflection, $property)->shouldThrow(
            new \RuntimeException('Could not read class <class@anonymous> source file contents, aborting.')
        )->duringCurrent();
    }

    function it_is_failing_at_opening_class_file(\ReflectionClass $reflection, \ReflectionProperty $property)
    {
        $this->beConstructedWith((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory());

        $object = new class {
            /** @var Inexistent */
            public $foo;
        };

        $property->beConstructedWith([$object, 'foo']);
        $property->getName()->willReturn('foo');
        $property->getDocComment()->willReturn('/** @var Inexistent */');

        $reflection->beConstructedWith([$object]);
        $reflection->getShortName()->willReturn(get_class($object));
        $reflection->isAnonymous()->willReturn(true);
        $reflection->getFileName()->willReturn('non-existent.php');

        $this('var', $reflection, $property)->shouldThrow(
            new \RuntimeException('Could not read class <class@anonymous> source file non-existent.php contents, aborting.')
        )->duringCurrent();
    }
}
