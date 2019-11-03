<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\FieldGuesser\FieldGuesserInterface;
use Kiboko\Component\ETL\Metadata\RelationGuesser\RelationGuesserInterface;
use Kiboko\Component\ETL\Metadata\TypeGuesser;
use Phpactor\Docblock\DocblockFactory;
use PhpParser\ParserFactory;

final class ClassMetadataBuilder implements ClassMetadataBuilderInterface
{
    /** @var FieldGuesserInterface */
    private $fieldGuesser;
    /** @var RelationGuesserInterface */
    private $relationGuesser;

    public function __construct(
        FieldGuesserInterface $fieldGuesser,
        RelationGuesserInterface $relationGuesser
    ) {
        $this->fieldGuesser = $fieldGuesser;
        $this->relationGuesser = $relationGuesser;
    }

    public function buildFromReference(ClassReferenceMetadata $class): ClassTypeMetadata
    {
        return $this->buildFromFQCN((string) $class);
    }

    public function buildFromFQCN(string $className): ClassTypeMetadata
    {
        try {
            return $this->build(new \ReflectionClass($className));
        } catch (\ReflectionException $e) {
            throw new \RuntimeException(
                strtr(
                    'The class %class.name% was not declared. It does either not exist or it does not have been auto-loaded.',
                    [
                        '%class.name%' => $className,
                    ]
                ),
                0,
                $e
            );
        }
    }

    public function buildFromObject(object $object): ClassTypeMetadata
    {
        return $this->build(new \ReflectionObject($object));
    }

    public function build(\ReflectionClass $classOrObject): ClassTypeMetadata
    {
        try {
            $fqcn = $classOrObject->getName();
            if (($index = strrpos($fqcn, '\\')) === false) {
                $object = new ClassTypeMetadata($fqcn);
            } else {
                $object = new ClassTypeMetadata(
                    substr($fqcn, $index + 1),
                    substr($fqcn, 0, $index)
                );
            }

            $typeGuesser = new TypeGuesser\CompositeTypeGuesser(
                version_compare(PHP_VERSION, '7.4.0') >= 0 ?
                    new TypeGuesser\Native\Php74TypeGuesser() :
                    new TypeGuesser\Native\DummyTypeGuesser(),
                new TypeGuesser\Docblock\DocblockTypeGuesser((new ParserFactory())->create(ParserFactory::ONLY_PHP7), new DocblockFactory())
            );

            $object->properties(...array_map(
                function(\ReflectionProperty $property) use($classOrObject, $typeGuesser) {
                    return new PropertyMetadata(
                        $property->getName(),
                        ...$typeGuesser($classOrObject, $property)
                    );
                },
                $classOrObject->getProperties(\ReflectionProperty::IS_PUBLIC)
            ));

            $object->methods(...array_map(
                function(\ReflectionMethod $method) use($classOrObject, $typeGuesser) {
                    return new MethodMetadata(
                        $method->getName(),
                        new ArgumentMetadataList(...array_map(function(\ReflectionParameter $parameter) use($typeGuesser, $classOrObject) {
                            if ($parameter->isVariadic()) {
                                return new VariadicArgumentMetadata(
                                    $parameter->getName(),
                                    ...$typeGuesser($classOrObject, $parameter)
                                );
                            }
                            return new ArgumentMetadata(
                                $parameter->getName(),
                                ...$typeGuesser($classOrObject, $parameter)
                            );
                        }, $method->getParameters())),
                        ...$typeGuesser($classOrObject, $method)
                    );
                },
                $classOrObject->getMethods(\ReflectionMethod::IS_PUBLIC)
            ));

            $object->fields(...($this->fieldGuesser)($this));

            $object->relations(...($this->relationGuesser)($this));
        } catch (\ReflectionException $e) {
            throw new \RuntimeException(
                'An error occurred during class metadata building.',
                0,
                $e
            );
        }

        return $object;
    }
}