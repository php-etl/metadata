<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\TypeGuesser;

use Kiboko\Component\Metadata\MixedTypeMetadata;
use Kiboko\Contract\Metadata\TypeMetadataInterface;
use Kiboko\Component\Metadata\UnionTypeMetadata;
use Kiboko\Contract\Metadata\TypeGuesser;

class CompositeTypeGuesser implements TypeGuesser\TypeGuesserInterface
{
    public function __construct(
        private TypeGuesser\Native\TypeGuesserInterface $php74Guesser,
        private TypeGuesser\Docblock\TypeGuesserInterface $docblockGuesser
    ) {}

    public function __invoke(\ReflectionClass $class, \Reflector $reflector): TypeMetadataInterface
    {
        $types = iterator_to_array($this->walkTypes($class, $reflector), false);

        if (count($types) <= 0) {
            return new MixedTypeMetadata();
        }
        if (count($types) > 1) {
            return new UnionTypeMetadata(...$types);
        }

        return reset($types);
    }

    private function walkTypes(\ReflectionClass $class, \Reflector $reflector): \Generator
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
        } elseif ($reflector instanceof \ReflectionMethod && $reflector->getReturnType() !== null) {
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
