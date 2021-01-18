<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\MethodGuesser;

use Kiboko\Component\Metadata\ArgumentMetadata;
use Kiboko\Component\Metadata\ArgumentListMetadata;
use Kiboko\Component\Metadata\ClassTypeMetadataInterface;
use Kiboko\Component\Metadata\MethodMetadata;
use Kiboko\Component\Metadata\TypeGuesser\TypeGuesserInterface;
use Kiboko\Component\Metadata\VariadicArgumentMetadata;

final class ReflectionMethodGuesser implements MethodGuesserInterface
{
    /** @var TypeGuesserInterface */
    private $typeGuesser;

    public function __construct(TypeGuesserInterface $typeGuesser)
    {
        $this->typeGuesser = $typeGuesser;
    }

    public function __invoke(\ReflectionClass $classOrObject, ClassTypeMetadataInterface $class): \Iterator
    {
        yield from array_map(
            function(\ReflectionMethod $method) use($classOrObject) {
                return new MethodMetadata(
                    $method->getName(),
                    new ArgumentListMetadata(...array_map(function(\ReflectionParameter $parameter) use($classOrObject) {
                        if ($parameter->isVariadic()) {
                            return new VariadicArgumentMetadata(
                                $parameter->getName(),
                                ($this->typeGuesser)($classOrObject, $parameter)
                            );
                        }
                        return new ArgumentMetadata(
                            $parameter->getName(),
                            ($this->typeGuesser)($classOrObject, $parameter)
                        );
                    }, $method->getParameters())),
                    ($this->typeGuesser)($classOrObject, $method)
                );
            },
            $classOrObject->getMethods(\ReflectionMethod::IS_PUBLIC)
        );
    }
}
