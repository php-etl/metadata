<?php

namespace Kiboko\Component\ETL\Metadata\Guesser\Native;

use Kiboko\Component\ETL\Metadata\ClassTypeMetadata;
use Kiboko\Component\ETL\Metadata\Guesser\TypeMetadataBuildingTrait;
use Kiboko\Component\ETL\Metadata\NullTypeMetadata;

class Php74TypeGuesser implements TypeGuesser
{
    use TypeMetadataBuildingTrait;

    public function __invoke(\ReflectionClass $class, \ReflectionType $reflector): \Generator
    {
        if ($reflector->isBuiltin()) {
            yield $this->simpleType(
                $reflector->getName(),
                true,
                $class
            );
        } else {
            yield new ClassTypeMetadata($reflector->getName());
        }

        if ($reflector->allowsNull()) {
            yield new NullTypeMetadata();
        }
    }
}