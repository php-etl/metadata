<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\FieldGuesser;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\Rules\English;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\MethodMetadata;
use Kiboko\Component\ETL\Metadata\ScalarTypeMetadata;
use Kiboko\Component\ETL\Metadata\Type;
use Kiboko\Component\ETL\Metadata\VirtualFieldMetadata;

final class VirtualFieldGuesser implements FieldGuesserInterface
{
    /** @var Inflector */
    private $inflector;

    public function __construct(?Inflector $inflector = null)
    {
        $this->inflector = $inflector ?? (new English\InflectorFactory())();
    }

    private function isSingular(string $field): bool
    {
        return $this->inflector->singularize($field) === $field;
    }

    public function __invoke(ClassTypeMetadata $class): \Iterator
    {
        $methodCandidates = [];
        /** @var MethodMetadata $method */
        foreach ($class->getMethods() as $method) {
            if (preg_match('/is(?<fieldName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
                Type::isOneOf(new ScalarTypeMetadata('bool'), ...$method->getReturnTypes()) &&
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
                if (!isset($methodCandidates[$fieldName])) {
                    $methodCandidates[$fieldName] = [];
                }

                $methodCandidates[$fieldName][$action] = $method;
            } else if (preg_match('/(?<action>unset|remove|get|has)(?<fieldName>[a-zA-Z_][a-zA-Z0-9_]*)/', $method->getName(), $matches) &&
                count($method->getArguments()) === 0
            ) {
                $action = $matches['action'];
                $fieldName = $this->inflector->camelize($matches['fieldName']);
                if (!$this->isSingular($fieldName)) {
                    continue;
                }
                if (!isset($methodCandidates[$fieldName])) {
                    $methodCandidates[$fieldName] = [];
                }

                $methodCandidates[$fieldName][$action] = $method;
            }
        }

        foreach ($methodCandidates as $fieldName => $actions) {
            /** @var MethodMetadata $accessor */
            $accessor = $actions['get'] ?? $actions['is'] ?? null;
            /** @var MethodMetadata $mutator */
            $mutator = $actions['set'] ?? null;

            if (!isset($accessor) && !isset($mutator)) {
                continue;
            }

            yield new VirtualFieldMetadata(
                $fieldName,
                $accessor,
                $mutator,
                $actions['has'] ?? null,
                $actions['unset'] ?? $actions['remove'] ?? null
            );
        }
    }
}