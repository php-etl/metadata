<?php

namespace Kiboko\Component\ETL\Metadata\Guesser;

use Kiboko\Component\ETL\Metadata\TypeMetadata;

class CompositeTypeGuesser implements TypeGuesser
{
    /** @var Native\TypeGuesser */
    private $php74Guesser;
    /** @var Docblock\TypeGuesser */
    private $docblockGuesser;

    public function __construct(
        Native\TypeGuesser $php74Guesser,
        Docblock\TypeGuesser $docblockGuesser
    ) {
        $this->php74Guesser = $php74Guesser;
        $this->docblockGuesser = $docblockGuesser;
    }

    /**
     * @return TypeMetadata[]
     */
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): \Generator
    {
        if (!$reflector instanceof \ReflectionProperty &&
            !$reflector instanceof \ReflectionMethod &&
            !$reflector instanceof \ReflectionParameter
        ) {
            throw new \InvalidArgumentException(
                'Expected object of type \\ReflectionProperty, \\ReflectionMethod or \\ReflectionParameter.'
            );
        }

        if (($reflector instanceof \ReflectionProperty || $reflector instanceof \ReflectionParameter) &&
            $reflector->getType()
        ) {
            yield from ($this->php74Guesser)($class, $reflector->getType());
        } else if ($reflector instanceof \ReflectionMethod && $reflector->getReturnType()) {
            yield from ($this->php74Guesser)($class, $reflector->getReturnType());
        }

        if ($reflector instanceof \ReflectionMethod || $reflector instanceof \ReflectionProperty) {
            yield from ($this->docblockGuesser)($class, $reflector);
        }
    }
}