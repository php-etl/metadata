<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\FieldGuesser;

use Doctrine\Inflector;
use Kiboko\Component\Metadata\MixedTypeMetadata;
use Kiboko\Component\Metadata\ScalarTypeMetadata;
use Kiboko\Component\Metadata\Type;
use Kiboko\Component\Metadata\VirtualFieldMetadata;
use Kiboko\Contract\Metadata\ArgumentListMetadataInterface;
use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\FieldGuesserInterface;
use Kiboko\Contract\Metadata\MethodMetadataInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;

final class VirtualFieldGuesser implements FieldGuesserInterface
{
    private Inflector\Inflector $inflector;

    public function __construct(?Inflector\Inflector $inflector = null)
    {
        $this->inflector = $inflector ?? Inflector\InflectorFactory::createForLanguage(Inflector\Language::ENGLISH)->build();
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
            } elseif (preg_match('/(?<action>set)(?<fieldName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
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
            } elseif (preg_match('/(?<action>unset|remove|get|has)(?<fieldName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
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
                $this->guessType(...$typesCandidates[$fieldName]),
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
