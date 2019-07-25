<?php

namespace spec\Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\ClassMetadata;
use Kiboko\Component\ETL\Metadata\ClassMetadataBuilder;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\CollectionTypeMetadata;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use PhpSpec\ObjectBehavior;

class ClassMetadataBuilderSpec extends ObjectBehavior
{
    public function getMatchers(): array
    {
        return [
            'havePropertyCount' => function (ClassMetadata $subject) {
                return count($subject->properties);
            },
            'haveCompositedPropertyIsInstanceOf' => function (ClassMetadata $subject, string $property, string $class) {
                foreach ($subject->properties[$property]->types as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata &&
                        $typeDeclaration->inner instanceof ClassTypeMetadata &&
                        is_a($typeDeclaration->inner->name, $class, true)
                    ) {
                        return true;
                    }

                    if ($typeDeclaration instanceof CollectionTypeMetadata &&
                        $typeDeclaration->type instanceof ClassTypeMetadata &&
                        is_a($typeDeclaration->type->name, $class, true)
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveCompositedPropertyIsType' => function (ClassMetadata $subject, string $property, string $type) {
                foreach ($subject->properties[$property]->types as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata &&
                        $typeDeclaration->inner instanceof ScalarTypeMetadata &&
                        is_a($typeDeclaration->inner->name, $type, true)
                    ) {
                        return true;
                    }

                    if ($typeDeclaration instanceof CollectionTypeMetadata &&
                        $typeDeclaration->type instanceof ScalarTypeMetadata &&
                        is_a($typeDeclaration->type->name, $type, true)
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveCompositedProperty' => function (ClassMetadata $subject, string $property) {
                foreach ($subject->properties[$property]->types as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata || $typeDeclaration instanceof CollectionTypeMetadata) {
                        return true;
                    }
                }

                return false;
            },
            'havePropertyIsInstanceOf' => function (ClassMetadata $subject, string $property, string $class) {
                foreach ($subject->properties[$property]->types as $typeDeclaration) {
                    if (($typeDeclaration instanceof ClassTypeMetadata && is_a($typeDeclaration->name, $class, true)) ||
                        ($typeDeclaration instanceof CollectionTypeMetadata && is_a($typeDeclaration->type->name, $class, true))
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'havePropertyIsType' => function (ClassMetadata $subject, string $property, string $type) {
                foreach ($subject->properties[$property]->types as $typeDeclaration) {
                    if (($typeDeclaration instanceof ClassTypeMetadata && $typeDeclaration->name === $type) ||
                        ($typeDeclaration instanceof CollectionTypeMetadata && $typeDeclaration->type->name === $type) ||
                        ($typeDeclaration instanceof ListTypeMetadata && in_array($type, ['array', 'iterable']))
                    ) {
                        return true;
                    }
                }

                return false;
            },

            'haveMethodCount' => function (ClassMetadata $subject) {
                return count($subject->methods);
            },
            'haveCompositedMethodReturnIsInstanceOf' => function (ClassMetadata $subject, string $method, string $class) {
                foreach ($subject->methods[$method]->returnTypes as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata &&
                        $typeDeclaration->inner instanceof ClassTypeMetadata &&
                        is_a($typeDeclaration->inner->name, $class, true)
                    ) {
                        return true;
                    }

                    if ($typeDeclaration instanceof CollectionTypeMetadata &&
                        $typeDeclaration->type instanceof ClassTypeMetadata &&
                        is_a($typeDeclaration->type->name, $class, true)
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveCompositedMethodReturnIsType' => function (ClassMetadata $subject, string $method, string $type) {
                foreach ($subject->methods[$method]->returnTypes as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata &&
                        $typeDeclaration->inner instanceof ScalarTypeMetadata &&
                        is_a($typeDeclaration->inner->name, $type, true)
                    ) {
                        return true;
                    }

                    if ($typeDeclaration instanceof CollectionTypeMetadata &&
                        $typeDeclaration->type instanceof ScalarTypeMetadata &&
                        is_a($typeDeclaration->type->name, $type, true)
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveCompositedMethodReturn' => function (ClassMetadata $subject, string $method) {
                foreach ($subject->methods[$method]->returnTypes as $typeDeclaration) {
                    if ($typeDeclaration instanceof ListTypeMetadata || $typeDeclaration instanceof CollectionTypeMetadata) {
                        return true;
                    }
                }

                return false;
            },
            'haveMethodReturnIsInstanceOf' => function (ClassMetadata $subject, string $method, string $class) {
                foreach ($subject->methods[$method]->returnTypes as $typeDeclaration) {
                    if (($typeDeclaration instanceof ClassTypeMetadata && is_a($typeDeclaration->name, $class, true)) ||
                        ($typeDeclaration instanceof CollectionTypeMetadata && is_a($typeDeclaration->type->name, $class, true))
                    ) {
                        return true;
                    }
                }

                return false;
            },
            'haveMethodReturnIsType' => function (ClassMetadata $subject, string $method, string $type) {
                foreach ($subject->methods[$method]->returnTypes as $typeDeclaration) {
                    if (($typeDeclaration instanceof ClassTypeMetadata && $typeDeclaration->name === $type) ||
                        ($typeDeclaration instanceof CollectionTypeMetadata && $typeDeclaration->type->name === $type) ||
                        ($typeDeclaration instanceof ListTypeMetadata && in_array($type, ['array', 'iterable']))
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
        $this->shouldHaveType(ClassMetadataBuilder::class);
    }

    function it_accepts_anonymous_classes()
    {
        $object = new class {};

        $this->buildFromObject($object)->shouldReturnAnInstanceOf(ClassMetadata::class);
    }

    function it_reads_properties()
    {
        $object = new class {
            public $foo;
        };

        $this->buildFromObject($object)->shouldHavePropertyCount(1);
    }

    function it_detects_properties_type()
    {
        $object = new class {
            /** @var \stdClass */
            public $foo;
        };

        $this->buildFromObject($object)->shouldNotHaveCompositedProperty('foo');
        $this->buildFromObject($object)->shouldHavePropertyIsInstanceOf('foo', \stdClass::class);
    }

    function it_detects_properties_arrays()
    {
        $object = new class {
            /** @var \stdClass[] */
            public $foo;
        };

        $this->buildFromObject($object)->shouldHaveCompositedProperty('foo');
        $this->buildFromObject($object)->shouldHaveCompositedPropertyIsInstanceOf('foo', \stdClass::class);
        $this->buildFromObject($object)->shouldHavePropertyIsType('foo', 'array');
    }

    function it_reads_methods()
    {
        $object = new class {
            public function foo() {}
        };

        $this->buildFromObject($object)->shouldHaveMethodCount(1);
    }

    function it_detects_methods_return_type()
    {
        $object = new class {
            /** @return \stdClass */
            public function foo(){}
        };

        $this->buildFromObject($object)->shouldNotHaveCompositedMethodReturn('foo');
//        $this->buildFromObject($object)->shouldHaveMethodReturnIsInstanceOf('foo', \stdClass::class);
    }

    function it_detects_methods_return_arrays()
    {
        $object = new class {
            /** @return \stdClass[] */
            public function foo(){}
        };

//        $this->buildFromObject($object)->shouldHaveCompositedMethodReturn('foo');
//        $this->buildFromObject($object)->shouldHaveCompositedMethodReturnIsInstanceOf('foo', \stdClass::class);
//        $this->buildFromObject($object)->shouldHaveMethodReturnIsType('foo', 'array');
    }
}
