<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\MethodMetadataInterface;

/**
 * @template Subject of object
 */
trait ClassMethodsTrait
{
    /** @var list<MethodMetadataInterface<Subject>> */
    private array $methods = [];

    /**
     * @return iterable<MethodMetadataInterface<Subject>>
     */
    public function getMethods(): iterable
    {
        return new \ArrayIterator($this->methods);
    }

    /**
     * @return MethodMetadataInterface<Subject>
     */
    public function getMethod(string $name): MethodMetadataInterface
    {
        if (!isset($this->methods[$name])) {
            throw new \OutOfBoundsException(strtr('There is no method named %method%', ['%method%' => $name]));
        }

        return $this->methods[$name];
    }

    /**
     * @param MethodMetadataInterface<Subject> ...$methods
     * @return ClassTypeMetadataInterface<Subject>
     */
    public function addMethods(MethodMetadataInterface ...$methods): ClassTypeMetadataInterface
    {
        foreach ($methods as $method) {
            $this->methods[$method->getName()] = $method;
        }

        return $this;
    }
}
