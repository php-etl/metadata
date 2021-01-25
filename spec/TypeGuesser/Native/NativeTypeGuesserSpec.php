<?php

namespace spec\Kiboko\Component\Metadata\TypeGuesser\Native;

use Kiboko\Component\Metadata\ArrayTypeMetadata;
use Kiboko\Component\Metadata\ClassReferenceMetadata;
use Kiboko\Component\Metadata\NullTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\TypeMetadataInterface;
use Kiboko\Component\Metadata\TypeGuesser;
use PhpSpec\ObjectBehavior;

class NativeTypeGuesserSpec extends ObjectBehavior
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
        $this->shouldHaveType(TypeGuesser\Native\NativeTypeGuesser::class);
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
                new ClassReferenceMetadata('stdClass')
            );
    }
}
