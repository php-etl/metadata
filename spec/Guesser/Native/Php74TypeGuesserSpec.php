<?php

namespace spec\Kiboko\Component\ETL\Metadata\Guesser\Native;

use Kiboko\Component\ETL\Metadata\ArrayTypeMetadata;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\TypeMetadata;
use Kiboko\Component\ETL\Metadata\Guesser;
use PhpSpec\ObjectBehavior;

class Php74TypeGuesserSpec extends ObjectBehavior
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
        $this->shouldHaveType(Guesser\Native\Php74TypeGuesser::class);
    }

    function it_is_discovering_one_php74_scalar_type()
    {
        $object = new class {
            public string $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo')->getType())
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string')
            );
    }

    function it_is_discovering_one_php74_nullable_scalar_type()
    {
        $object = new class {
            public ?string $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo')->getType())
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('string'),
                new NullTypeMetadata()
            );
    }

    function it_is_discovering_php74_array_type()
    {
        $object = new class {
            public array $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo')->getType())
            ->shouldMatchTypeMetadata(
                new ArrayTypeMetadata()
            );
    }

    function it_is_discovering_php74_array_type_with_docblock()
    {
        $object = new class {
            /** @var \stdClass[] */
            public array $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo')->getType())
            ->shouldMatchTypeMetadata(
                new ArrayTypeMetadata()
            );
    }

    function it_is_discovering_php74_iterable_type()
    {
        $object = new class {
            public iterable $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo')->getType())
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('iterable')
            );
    }

    function it_is_discovering_php74_iterable_type_with_docblock()
    {
        $object = new class {
            /** @var \stdClass[] */
            public iterable $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo')->getType())
            ->shouldMatchTypeMetadata(
                new ScalarTypeMetadata('iterable'),
            );
    }

    function it_is_discovering_php74_class_type()
    {
        $object = new class {
            public \stdClass $foo;
        };

        $reflection = new \ReflectionObject($object);

        $this($reflection, $reflection->getProperty('foo')->getType())
            ->shouldMatchTypeMetadata(
                new ClassTypeMetadata(\stdClass::class)
            );
    }
}
