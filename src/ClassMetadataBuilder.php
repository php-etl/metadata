<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata;

use Kiboko\Component\ETL\Metadata\FieldGuesser;
use Kiboko\Component\ETL\Metadata\MethodGuesser;
use Kiboko\Component\ETL\Metadata\PropertyGuesser;
use Kiboko\Component\ETL\Metadata\RelationGuesser;

final class ClassMetadataBuilder implements ClassMetadataBuilderInterface
{
    /** @var PropertyGuesser\PropertyGuesserInterface */
    private $propertyGuesser;
    /** @var MethodGuesser\MethodGuesserInterface */
    private $methodGuesser;
    /** @var FieldGuesser\FieldGuesserInterface */
    private $fieldGuesser;
    /** @var RelationGuesser\RelationGuesserInterface */
    private $relationGuesser;

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
                $metadata = new ClassTypeMetadata($fqcn);
            } else {
                $metadata = new ClassTypeMetadata(
                    substr($fqcn, $index + 1),
                    substr($fqcn, 0, $index)
                );
            }

            $metadata->properties(...($this->propertyGuesser)($classOrObject, $metadata));

            $metadata->methods(...($this->methodGuesser)($classOrObject, $metadata));

            $metadata->fields(...($this->fieldGuesser)($metadata));

            $metadata->relations(...($this->relationGuesser)($metadata));
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