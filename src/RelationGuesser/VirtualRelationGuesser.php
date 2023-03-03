<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\RelationGuesser;

use Doctrine\Inflector;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\Type;
use Kiboko\Component\Metadata\VirtualMultipleRelationMetadata;
use Kiboko\Component\Metadata\VirtualUnaryRelationMetadata;
use Kiboko\Component\Metadata\VoidTypeMetadata;
use Kiboko\Contract\Metadata\ArgumentListMetadataInterface;
use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\MethodMetadataInterface;
use Kiboko\Contract\Metadata\RelationGuesserInterface;
use Kiboko\Contract\Metadata\RelationMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class VirtualRelationGuesser implements RelationGuesserInterface
{
    private readonly Inflector\Inflector $inflector;

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

    /**
     * @template Subject of object
     * @param ClassTypeMetadataInterface<Subject> $class
     * @return \Iterator<RelationMetadataInterface<Subject>>
     */
    public function __invoke(ClassTypeMetadataInterface $class): \Iterator
    {
        $typesCandidates = [];
        $methodCandidates = [];
        /** @var MethodMetadataInterface $method */
        foreach ($class->getMethods() as $method) {
            if ($method->getReturnType() instanceof VoidTypeMetadata || $method->getReturnType() instanceof ScalarTypeMetadata) {
                continue;
            }

            if (preg_match('/(?<action>set|remove|add|has)(?<relationName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches)
                && 1 === \count($method->getArguments())
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
            } elseif (preg_match('/(?<action>unset|get)(?<relationName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches)
                && 0 === \count($method->getArguments())
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
            } elseif (preg_match('/count(?<relationName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches)
                && Type::is($method->getReturnType(), new ScalarTypeMetadata('integer'))
                && 0 === \count($method->getArguments())
            ) {
                $relationName = $this->inflector->camelize($matches['relationName']);
                if (!isset($methodCandidates[$relationName])) {
                    $methodCandidates[$relationName] = [];
                }

                $methodCandidates[$relationName]['count'] = $method;
            } elseif (preg_match('/walk(?<relationName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches)
                && Type::is($method->getReturnType(), new ScalarTypeMetadata('iterable'))
                && 0 === \count($method->getArguments())
            ) {
                $relationName = $this->inflector->camelize($matches['relationName']);
                if (!isset($methodCandidates[$relationName])) {
                    $methodCandidates[$relationName] = [];
                }

                $methodCandidates[$relationName]['walk'] = $method;
            }
        }

        foreach ($methodCandidates as $relationName => $actions) {
            if (empty($typesCandidates[$relationName])) {
                continue;
            }

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
        return reset($types);
    }
}
