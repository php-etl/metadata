<?php

namespace Kiboko\Component\ETL\Metadata\Guesser;

use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;

class CompositeTypeGuesser implements TypeGuesserInterface
{
    /** @var Native\TypeGuesserInterface */
    private $php74Guesser;
    /** @var Docblock\TypeGuesserInterface */
    private $docblockGuesser;

    public function __construct(
        Native\TypeGuesserInterface $php74Guesser,
        Docblock\TypeGuesserInterface $docblockGuesser
    ) {
        $this->php74Guesser = $php74Guesser;
        $this->docblockGuesser = $docblockGuesser;
    }

    /**
     * @return \Generator<TypeMetadataInterface>
     */
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): \Iterator
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
            $reflector->getType() !== null
        ) {
            yield from ($this->php74Guesser)($class, $reflector->getType());
        } else if ($reflector instanceof \ReflectionMethod && $reflector->getReturnType() !== null) {
            yield from ($this->php74Guesser)($class, $reflector->getReturnType());
        }

        if ($reflector instanceof \ReflectionMethod) {
            yield from ($this->docblockGuesser)('return', $class, $reflector);
        }
        if ($reflector instanceof \ReflectionProperty) {
            yield from ($this->docblockGuesser)('var', $class, $reflector);
        }
        if ($reflector instanceof \ReflectionParameter) {
// FIXME: implement the way od discovering parameter docblocks
//            yield from ($this->docblockGuesser)('param', $class, $reflector);
        }
    }
}