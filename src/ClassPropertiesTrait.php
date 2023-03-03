<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\PropertyMetadataInterface;

/**
 * @template Subject of object
 */
trait ClassPropertiesTrait
{
    /** @var list<PropertyMetadataInterface<Subject>> */
    private array $properties = [];

    /**
     * @return iterable<PropertyMetadataInterface<Subject>>
     */
    public function getProperties(): iterable
    {
        return new \ArrayIterator($this->properties);
    }

    /**
     * @return PropertyMetadataInterface<Subject>
     */
    public function getProperty(string $name): PropertyMetadataInterface
    {
        if (!isset($this->properties[$name])) {
            throw new \OutOfBoundsException(strtr('There is no property named %property%', ['%property%' => $name]));
        }

        return $this->properties[$name];
    }

    /**
     * @param PropertyMetadataInterface<Subject> ...$properties
     * @return ClassTypeMetadataInterface<Subject>
     */
    public function addProperties(PropertyMetadataInterface ...$properties): ClassTypeMetadataInterface
    {
        foreach ($properties as $property) {
            $this->properties[$property->getName()] = $property;
        }

        return $this;
    }
}
