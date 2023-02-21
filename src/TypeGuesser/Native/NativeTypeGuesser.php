<?php

declare(strict_types=1);

namespace Kiboko\Component\Metadata\TypeGuesser\Native;

use Kiboko\Component\Metadata\ClassReferenceMetadata;
use Kiboko\Component\Metadata\IntersectionTypeMetadata;
use Kiboko\Component\Metadata\NullTypeMetadata;
use Kiboko\Component\Metadata\TypeGuesser\TypeMetadataBuildingTrait;
use Kiboko\Component\Metadata\UnionTypeMetadata;
use Kiboko\Contract\Metadata\TypeGuesser\Native\TypeGuesserInterface;

class NativeTypeGuesser implements TypeGuesserInterface
{
    use TypeMetadataBuildingTrait;

    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Iterator
    {
        if ($reflector instanceof \ReflectionUnionType) {
            yield new UnionTypeMetadata(...array_map(fn ($reflector) => $this($class, $reflector), $reflector->getTypes()));
        } elseif ($reflector instanceof \ReflectionIntersectionType) {
            yield new IntersectionTypeMetadata(...array_map(fn ($reflector) => $this($class, $reflector), $reflector->getTypes()));
        } elseif ($reflector instanceof \ReflectionNamedType && $reflector->isBuiltin()) {
            yield $this->builtInType($reflector->getName());
        } elseif ('self' === $reflector->getName() || 'static' === $reflector->getName()) {
            try {
                $classReflector = new \ReflectionClass($class->getName());
                yield new ClassReferenceMetadata(
                    $classReflector->getShortName(),
                    $classReflector->getNamespaceName()
                );
            } catch (\ReflectionException $e) {
                throw new \RuntimeException(strtr('The class %class.name% was not declared. It does either not exist or it does not have been auto-loaded.', ['%class.name%' => $reflector->getName()]), 0, $e);
            }
        } else {
            try {
                $classReflector = new \ReflectionClass($reflector->getName());

                if ($classReflector->isAnonymous()) {
                    throw new \RuntimeException('Reached an unexpected anonymous class.');
                }
                yield new ClassReferenceMetadata(
                        $classReflector->getShortName(),
                        $classReflector->getNamespaceName()
                    );
            } catch (\ReflectionException $e) {
                throw new \RuntimeException(strtr('The class %class.name% was not declared. It does either not exist or it does not have been auto-loaded.', ['%class.name%' => $reflector->getName()]), 0, $e);
            }
        }

        if ($reflector->allowsNull()) {
            yield new NullTypeMetadata();
        }
    }
}
