<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\MethodGuesser;

use Kiboko\Component\ETL\Metadata\ArgumentMetadata;
use Kiboko\Component\ETL\Metadata\ArgumentListMetadata;
use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\MethodMetadata;
use Kiboko\Component\ETL\Metadata\TypeGuesser\TypeGuesserInterface;
use Kiboko\Component\ETL\Metadata\VariadicArgumentMetadata;

final class ReflectionMethodGuesser implements MethodGuesserInterface
{
    /** @var TypeGuesserInterface */
    private $typeGuesser;

    public function __construct(TypeGuesserInterface $typeGuesser)
    {
        $this->typeGuesser = $typeGuesser;
    }

    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadata $class): \Iterator
    {
        yield from array_map(
            function(\ReflectionMethod $method) use($classOrObject) {
                return new MethodMetadata(
                    $method->getName(),
                    new ArgumentListMetadata(...array_map(function(\ReflectionParameter $parameter) use($classOrObject) {
                        if ($parameter->isVariadic()) {
                            return new VariadicArgumentMetadata(
                                $parameter->getName(),
                                ...($this->typeGuesser)($classOrObject, $parameter)
                            );
                        }
                        return new ArgumentMetadata(
                            $parameter->getName(),
                            ...($this->typeGuesser)($classOrObject, $parameter)
                        );
                    }, $method->getParameters())),
                    ($this->typeGuesser)($classOrObject, $method)
                );
            },
            $classOrObject->getMethods(\ReflectionMethod::IS_PUBLIC)
        );
    }
}