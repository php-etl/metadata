<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\RelationGuesser;

use Doctrine\Inflector;
use Kiboko\Component\Metadata\ArgumentListMetadataInterface;
use Kiboko\Component\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\Metadata\MethodMetadataInterface;
use Kiboko\Component\Metadata\MixedTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\Type;
use Kiboko\Component\Metadata\TypeMetadataInterface;
use Kiboko\Component\Metadata\VirtualMultipleRelationMetadata;
use Kiboko\Component\Metadata\VirtualUnaryRelationMetadata;

final class VirtualRelationGuesser implements RelationGuesserInterface
{
    private Inflector\Inflector $inflector;

    public function __construct(?Inflector\Inflector $inflector = null)
    {
        $this->inflector = $inflector ?? Inflector\InflectorFactory::createForLanguage(Inflector\Language::ENGLISH)->build();
    }

    private function isPlural(string $field): bool
    {
        return $this->inflector->pluralize($field) === $field;
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
            if (preg_match('/(?<action>set|remove|add|has)(?<relationName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
                count($method->getArguments()) === 1
            ) {
                $action = $matches['action'];
                $relationName = $this->inflector->camelize($matches['relationName']);
                if (!isset($typesCandidates[$relationName])) {
                    $typesCandidates[$relationName] = [];
                }
                if (!isset($methodCandidates[$relationName])) {
                    $methodCandidates[$relationName] = [];
                }

                array_push($typesCandidates[$relationName], $method->getReturnType());
                $methodCandidates[$relationName][$action] = $method;
            } elseif (preg_match('/(?<action>unset|get)(?<relationName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
                count($method->getArguments()) === 0
            ) {
                $action = $matches['action'];
                $relationName = $this->inflector->camelize($matches['relationName']);
                if (!isset($typesCandidates[$relationName])) {
                    $typesCandidates[$relationName] = [];
                }
                if (!isset($methodCandidates[$relationName])) {
                    $methodCandidates[$relationName] = [];
                }

                array_push($typesCandidates[$relationName], ...$this->extractArgumentTypes($method->getArguments()));
                $methodCandidates[$relationName][$action] = $method;
            } elseif (preg_match('/count(?<relationName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
                Type::is($method->getReturnType(), new ScalarTypeMetadata('integer')) &&
                count($method->getArguments()) === 0
            ) {
                $relationName = $this->inflector->camelize($matches['relationName']);
                if (!isset($methodCandidates[$relationName])) {
                    $methodCandidates[$relationName] = [];
                }

                $methodCandidates[$relationName]['count'] = $method;
            } elseif (preg_match('/walk(?<relationName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
                Type::is($method->getReturnType(), new ScalarTypeMetadata('iterable')) &&
                count($method->getArguments()) === 0
            ) {
                $relationName = $this->inflector->camelize($matches['relationName']);
                if (!isset($methodCandidates[$relationName])) {
                    $methodCandidates[$relationName] = [];
                }

                $methodCandidates[$relationName]['walk'] = $method;
            }
        }

        foreach ($methodCandidates as $relationName => $actions) {
            if ($this->isPlural($relationName)) {
                yield new VirtualMultipleRelationMetadata(
                    $relationName,
                    $this->guessType(...$typesCandidates[$relationName]),
                    $actions['get'] ?? null,
                    $actions['set'] ?? null,
                    $actions['add'] ?? null,
                    $actions['remove'] ?? null,
                    $actions['walk'] ?? null,
                    $actions['count'] ?? null
                );
            }
            if ($this->isSingular($relationName)) {
                yield new VirtualUnaryRelationMetadata(
                    $relationName,
                    $this->guessType(...array_values($typesCandidates[$relationName])),
                    $actions['get'] ?? $actions['is'] ?? null,
                    $actions['set'] ?? null,
                    $actions['has'] ?? null,
                    $actions['unset'] ?? null
                );
            }
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
