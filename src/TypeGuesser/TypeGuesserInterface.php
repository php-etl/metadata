<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\TypeGuesser;

use Kiboko\Component\Metadata\TypeMetadataInterface;

interface TypeGuesserInterface
{
    public function __invoke(\ReflectionClass $class, \Reflector $reflector): TypeMetadataInterface;
}
