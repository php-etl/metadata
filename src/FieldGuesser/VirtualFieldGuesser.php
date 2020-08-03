<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\FieldGuesser;

use Doctrine\Common\Inflector\Inflector;
use Kiboko\Component\ETL\Metadata\ArgumentListMetadataInterface;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\MethodMetadataInterface;
use Kiboko\Component\ETL\Metadata\MixedTypeMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\Type;
use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;
use Kiboko\Component\ETL\Metadata\VirtualFieldMetadata;

final class VirtualFieldGuesser implements FieldGuesserInterface
{
    private Inflector $inflector;

    public function __construct(?Inflector $inflector = null)
    {
        $this->inflector = $inflector ?? new Inflector();
    }

    private function isSingular(string $field): bool
    {
        return $this->inflector->singularize($field) === $field;
    }

    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        $typesCandidates = [];
        $methodCandidates = [];
        /** @var MethodMetadataInterface $method */
        foreach ($class->getMethods() as $method) {
            if (preg_match('/is(?<fieldName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
                Type::is($method->getReturnType(), new ScalarTypeMetadata('bool')) &&
                count($method->getArguments()) === 0
            ) {
                $fieldName = $this->inflector->camelize($matches['fieldName']);
                if (!$this->isSingular($fieldName)) {
                    continue;
                }
                if (!isset($methodCandidates[$fieldName])) {
                    $methodCandidates[$fieldName] = [];
                }

                $methodCandidates[$fieldName]['is'] = $method;
            } else if (preg_match('/(?<action>set)(?<fieldName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
                count($method->getArguments()) === 1
            ) {
                $action = $matches['action'];
                $fieldName = $this->inflector->camelize($matches['fieldName']);
                if (!$this->isSingular($fieldName)) {
                    continue;
                }
                if (!isset($typesCandidates[$fieldName])) {
                    $typesCandidates[$fieldName] = [];
                }
                if (!isset($methodCandidates[$fieldName])) {
                    $methodCandidates[$fieldName] = [];
                }

                array_push($typesCandidates[$fieldName], ...$this->extractArgumentTypes($method->getArguments()));
                $methodCandidates[$fieldName][$action] = $method;
            } else if (preg_match('/(?<action>unset|remove|get|has)(?<fieldName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
                count($method->getArguments()) === 0
            ) {
                $action = $matches['action'];
                $fieldName = $this->inflector->camelize($matches['fieldName']);
                if (!$this->isSingular($fieldName)) {
                    continue;
                }
                if (!isset($typesCandidates[$fieldName])) {
                    $typesCandidates[$fieldName] = [];
                }
                if (!isset($methodCandidates[$fieldName])) {
                    $methodCandidates[$fieldName] = [];
                }

                $methodCandidates[$fieldName][$action] = $method;
            }
        }

        foreach ($methodCandidates as $fieldName => $actions) {
            /** @var MethodMetadataInterface $accessor */
            $accessor = $actions['get'] ?? $actions['is'] ?? null;
            /** @var MethodMetadataInterface $mutator */
            $mutator = $actions['set'] ?? null;

            if (!isset($accessor) && !isset($mutator)) {
                continue;
            }

            yield new VirtualFieldMetadata(
                $fieldName,
                $this->guessType($typesCandidates),
                $accessor,
                $mutator,
                $actions['has'] ?? null,
                $actions['unset'] ?? $actions['remove'] ?? null
            );
        }
    }

    private function extractArgumentTypes(ArgumentListMetadataInterface $arguments): iterable
    {
        foreach ($arguments as $argument) {
            yield $argument->getType();
        }
    }

    private function guessType(TypeMetadataInterface ...$types): TypeMetadataInterface
    {
        return reset($types) ?? new MixedTypeMetadata();
    }
}