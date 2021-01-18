<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Component\Metadata\FieldGuesser;
use Kiboko\Component\Metadata\MethodGuesser;
use Kiboko\Component\Metadata\PropertyGuesser;
use Kiboko\Component\Metadata\RelationGuesser;

final class ClassMetadataBuilder implements ClassMetadataBuilderInterface
{
    private PropertyGuesser\PropertyGuesserInterface $propertyGuesser;
    private MethodGuesser\MethodGuesserInterface $methodGuesser;
    private FieldGuesser\FieldGuesserInterface $fieldGuesser;
    private RelationGuesser\RelationGuesserInterface $relationGuesser;

    public function __construct(
        PropertyGuesser\PropertyGuesserInterface $propertyGuesser,
        MethodGuesser\MethodGuesserInterface $methodGuesser,
        FieldGuesser\FieldGuesserInterface $fieldGuesser,
        RelationGuesser\RelationGuesserInterface $relationGuesser
    ) {
        $this->propertyGuesser = $propertyGuesser;
        $this->methodGuesser = $methodGuesser;
        $this->fieldGuesser = $fieldGuesser;
        $this->relationGuesser = $relationGuesser;
    }

    public function buildFromReference(ClassReferenceMetadataInterface $class): ClassTypeMetadataInterface
    {
        return $this->buildFromFQCN((string) $class);
    }

    public function buildFromFQCN(string $className): ClassTypeMetadataInterface
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

    public function buildFromObject(object $object): ClassTypeMetadataInterface
    {
        return $this->build(new \ReflectionObject($object));
    }

    public function build(\ReflectionClass $classOrObject): ClassTypeMetadataInterface
    {
        try {
            $fqcn = $classOrObject->getName();
            if (($index = strrpos($fqcn, '\\')) === false) {
                $metadata = new ClassTypeMetadata($fqcn);
            } else {
                $metadata = new ClassTypeMetadata(
                    substr($fqcn, $index + 1),
                    substr($fqcn, 0, $index)
                );
            }

            $metadata->addProperties(...($this->propertyGuesser)($classOrObject, $metadata));

            $metadata->addMethods(...($this->methodGuesser)($classOrObject, $metadata));

            $metadata->addFields(...($this->fieldGuesser)($metadata));

            $metadata->addRelations(...($this->relationGuesser)($metadata));
        } catch (\ReflectionException $e) {
            throw new \RuntimeException(
                'An error occurred during class metadata building.',
                0,
                $e
            );
        }

        return $metadata;
    }
}
