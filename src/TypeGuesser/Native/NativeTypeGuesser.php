<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\TypeGuesser\Native;

use Kiboko\Component\Metadata\ClassReferenceMetadata;
use Kiboko\Component\Metadata\NullTypeMetadata;
use Kiboko\Component\Metadata\TypeGuesser\TypeMetadataBuildingTrait;
use Kiboko\Contract\Metadata\TypeGuesser\Native\TypeGuesserInterface;

class NativeTypeGuesser implements TypeGuesserInterface
{
    use TypeMetadataBuildingTrait;

    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Iterator
    {
        if ($reflector instanceof \ReflectionUnionType) {
            yield from array_map(fn ($reflector) => $this($class, $reflector), $reflector->getTypes());
        } else if ($reflector instanceof \ReflectionNamedType && $reflector->isBuiltin()) {
            yield $this->builtInType($reflector->getName());
        } else if ($reflector->getName() === 'self' || $reflector->getName() === 'static') {
            try {
                $classReflector = new \ReflectionClass($class->getName());
                yield new ClassReferenceMetadata(
                    $classReflector->getShortName(),
                    $classReflector->getNamespaceName()
                );
            } catch (\ReflectionException $e) {
                throw new \RuntimeException(
                    strtr(
                        'The class %class.name% was not declared. It does either not exist or it does not have been auto-loaded.',
                        [
                            '%class.name%' => $reflector->getName(),
                        ]
                    ),
                    0,
                    $e
                );
            }
        } else {
            try {
                $classReflector = new \ReflectionClass($reflector->getName());

                if ($classReflector->isAnonymous()) {
                    throw new \RuntimeException('Reached an unexpected anonymous class.');
                } else {
                    yield new ClassReferenceMetadata(
                        $classReflector->getShortName(),
                        $classReflector->getNamespaceName()
                    );
                }
            } catch (\ReflectionException $e) {
                throw new \RuntimeException(
                    strtr(
                        'The class %class.name% was not declared. It does either not exist or it does not have been auto-loaded.',
                        [
                            '%class.name%' => $reflector->getName(),
                        ]
                    ),
                    0,
                    $e
                );
            }
        }

        if ($reflector->allowsNull()) {
            yield new NullTypeMetadata();
        }
    }
}
