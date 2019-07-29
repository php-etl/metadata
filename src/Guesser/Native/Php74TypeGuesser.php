<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Native;

use Kiboko\Component\ETL\Metadata\ClassReferenceMetadata;
use Kiboko\Component\ETL\Metadata\Guesser\TypeMetadataBuildingTrait;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;

class Php74TypeGuesser implements TypeGuesserInterface
{
    use TypeMetadataBuildingTrait;

    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Iterator
    {
        if ($reflector->isBuiltin()) {
            yield $this->builtInType($reflector->getName());
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