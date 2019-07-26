<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Docblock;

use Kiboko\Component\ETL\Metadata\CollectionTypeMetadata;
use Kiboko\Component\ETL\Metadata\Guesser\TypeMetadataBuildingTrait;
use Kiboko\Component\ETL\Metadata\ListTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\Type;
use Kiboko\Component\ETL\Metadata\TypeMetadata;
use Phpactor\Docblock\DocblockFactory;
use Phpactor\Docblock\DocblockType;
use Phpactor\Docblock\Tag;

class DocblockTypeGuesser implements TypeGuesser
{
    use TypeMetadataBuildingTrait;

    /** @var DocblockFactory */
    private $docblockFactory;

    public function __construct(
        DocblockFactory $docblockFactory
    ) {
        $this->docblockFactory = $docblockFactory;
    }

    /**
     * @return TypeMetadata[]
     */
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): \Generator
    {
        if (!$reflector instanceof \ReflectionProperty &&
            !$reflector instanceof \ReflectionMethod &&
            !$reflector instanceof \ReflectionParameter
        ) {
            throw new \InvalidArgumentException(
                'Expected object of type \\ReflectionProperty, \\ReflectionMethod or \\ReflectionParameter.'
            );
        }

        $docBlock = $this->docblockFactory->create($reflector->getDocComment());
        /** @var Tag\VarTag $tag */
        foreach ($docBlock->tags()->byName('var') as $tag) {
            /** @var DocblockType $type */
            foreach ($tag->types() as $type) {
                yield $this->guessType(
                    (string) $type,
                    $type->iteratedType(),
                    $type->isArray(),
                    $type->isCollection(),
                    $type->isFullyQualified(),
                    $class
                );
            }
        }
    }

    private function guessType(
        string $type,
        ?string $iterated,
        bool $isArray,
        bool $isCollection,
        bool $isFullyQualified,
        \ReflectionClass $reflector
    ) {
        if ($isCollection) {
            if ($iterated === null) {
                return new ScalarTypeMetadata($type);
            }

            if (in_array($iterated, Type::$builtInTypes)) {
                return new ListTypeMetadata(
                    $this->simpleType($iterated, $isFullyQualified, $reflector)
                );
            }

            return new CollectionTypeMetadata(
                $this->simpleType($type, $isFullyQualified, $reflector),
                $this->simpleType($iterated, $isFullyQualified, $reflector)
            );
        }

        return $isArray ?
            $this->listType($type, $iterated, $isFullyQualified, $reflector) :
            $this->simpleType($type, $isFullyQualified, $reflector);
    }
}