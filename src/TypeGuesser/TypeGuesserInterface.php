<?php declare(strict_types=1);

namespace Kiboko\Component\ETL\Metadata\TypeGuesser;

use Kiboko\Component\ETL\Metadata\TypeMetadataInterface;

interface TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): TypeMetadataInterface;
}