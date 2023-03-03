<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassMetadataBuilderInterface;
use Kiboko\Contract\Metadata\ClassReferenceMetadataInterface;
use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\FieldGuesserInterface;
use Kiboko\Contract\Metadata\MethodGuesserInterface;
use Kiboko\Contract\Metadata\PropertyGuesserInterface;
use Kiboko\Contract\Metadata\RelationGuesserInterface;

final readonly class ClassMetadataBuilder implements ClassMetadataBuilderInterface
{
    public function __construct(
        private PropertyGuesserInterface $propertyGuesser,
        private MethodGuesserInterface $methodGuesser,
        private FieldGuesserInterface $fieldGuesser,
        private RelationGuesserInterface $relationGuesser
    ) {
    }

    /**
     * @template Subject of object
     * @param ClassReferenceMetadataInterface<Subject> $class
     * @return ClassTypeMetadataInterface<Subject>
     */
    public function buildFromReference(ClassReferenceMetadataInterface $class): ClassTypeMetadataInterface
    {
        return $this->buildFromFQCN((string) $class);
    }

    /**
     * @template Subject of object
     * @param class-string<Subject> $className
     * @return ClassTypeMetadataInterface<Subject>
     */
    public function buildFromFQCN(string $className): ClassTypeMetadataInterface
    {
        try {
            return $this->build(new \ReflectionClass($className));
        } catch (\ReflectionException $e) {
            throw new \RuntimeException(strtr('The class %class.name% was not declared. It does either not exist or it does not have been auto-loaded.', ['%class.name%' => $className]), 0, $e);
        }
    }

    /**
     * @template Subject of object
     * @param Subject $object
     * @return ClassTypeMetadataInterface
     */
    public function buildFromObject(object $object): ClassTypeMetadataInterface
    {
        return $this->build(new \ReflectionObject($object));
    }

    /**
     * @template Subject of object
     * @param \ReflectionClass<Subject> $classOrObject
     * @return ClassTypeMetadataInterface<Subject>
     */
    public function build(\ReflectionClass $classOrObject): ClassTypeMetadataInterface
    {
        try {
            /** @var ClassTypeMetadata<Subject> $metadata */
            $metadata = ClassTypeMetadata::fromClassName($classOrObject->getName());

            $metadata->addProperties(...($this->propertyGuesser)($classOrObject, $metadata));

            $metadata->addMethods(...($this->methodGuesser)($classOrObject, $metadata));

            $metadata->addFields(...($this->fieldGuesser)($metadata));

            $metadata->addRelations(...($this->relationGuesser)($metadata));
        } catch (\ReflectionException $e) {
            throw new \RuntimeException('An error occurred during class metadata building.', 0, $e);
        }

        return $metadata;
    }
}
