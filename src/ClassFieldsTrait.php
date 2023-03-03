<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata;

use Kiboko\Contract\Metadata\ClassTypeMetadataInterface;
use Kiboko\Contract\Metadata\FieldMetadataInterface;

/**
 * @template Subject of object
 */
trait ClassFieldsTrait
{
    /** @var list<FieldMetadataInterface<Subject>> */
    private array $fields = [];

    /**
     * @return iterable<FieldMetadataInterface<Subject>>
     */
    public function getFields(): iterable
    {
        return new \ArrayIterator($this->fields);
    }

    /**
     * @return FieldMetadataInterface<Subject>
     */
    public function getField(string $name): FieldMetadataInterface
    {
        if (!isset($this->fields[$name])) {
            throw new \OutOfBoundsException(strtr('There is no field named %field%', ['%field%' => $name]));
        }

        return $this->fields[$name];
    }

    /**
     * @param FieldMetadataInterface<Subject> ...$fields
     * @return ClassTypeMetadataInterface<Subject>
     */
    public function addFields(FieldMetadataInterface ...$fields): ClassTypeMetadataInterface
    {
        foreach ($fields as $field) {
            $this->fields[$field->getName()] = $field;
        }

        return $this;
    }
}
