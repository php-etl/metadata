<?php declare(strict_types=1);

namespace Kiboko\Component\Metadata\TypeGuesser\Docblock;

use Kiboko\Component\Metadata\ArrayTypeMetadata;
use Kiboko\Component\Metadata\CollectionTypeMetadata;
use Kiboko\Component\Metadata\ListTypeMetadata;
use Kiboko\Component\Metadata\Type;
use Kiboko\Component\Metadata\TypeGuesser\TypeMetadataBuildingTrait;
use Kiboko\Contract\Metadata\TypeGuesser\Docblock\TypeGuesserInterface;
use Kiboko\Contract\Metadata\TypeMetadataInterface;
use Phpactor\Docblock\DocblockFactory;
use Phpactor\Docblock\DocblockType;
use Phpactor\Docblock\Tag;
use PhpParser\Node\Name;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\Parser;

class DocblockTypeGuesser implements TypeGuesserInterface
{
    use TypeMetadataBuildingTrait;

    public function __construct(
        private Parser $parser,
        private DocblockFactory $docblockFactory
    ) {
    }

    /**
     * @return \Generator<TypeMetadataInterface>
     */
    public function __invoke(string $tagName, \ReflectionClass $class, \Reflector $reflector): \Iterator
    {
        if (!$reflector instanceof \ReflectionProperty &&
            !$reflector instanceof \ReflectionMethod
        ) {
            throw new \InvalidArgumentException(
                'Expected object of type \\ReflectionProperty, \\ReflectionMethod or \\ReflectionParameter.'
            );
        }

        if (($comment = $reflector->getDocComment()) === false) {
            return;
        }

        $docBlock = $this->docblockFactory->create($comment);
        /** @var Tag\VarTag $tag */
        foreach ($docBlock->tags()->byName($tagName) as $tag) {
            /** @var DocblockType $type */
            foreach ($tag->types() as $type) {
                yield $this->guessType(
                    (string) $type,
                    $type->iteratedType(),
                    $type->isArray(),
                    $type->isCollection(),
                    $class
                );
            }
        }
    }

    private function detectFQCN(string $name, \ReflectionClass $classContext)
    {
        if (strpos($name, '\\') === 0) {
            return $name;
        }

        $traverser = new NodeTraverser();
        $traverser->addVisitor($nameResolver = new NameResolver());

        if ($classContext->getFileName() === false) {
            throw new \RuntimeException(strtr(
                'Could not read class %class.name% source file contents, aborting.',
                [
                    '%class.name%' => $classContext->isAnonymous() ? '<class@anonymous>' : $classContext->getShortName(),
                ]
            ));
        }

        if (($content = @file_get_contents($classContext->getFileName())) === false) {
            throw new \RuntimeException(
                strtr(
                    'Could not read class %class.name% source file %class.filename% contents, aborting.',
                    [
                    '%class.name%' => $classContext->isAnonymous() ? '<class@anonymous>' : $classContext->getShortName(),
                    '%class.filename%' =>$classContext->getFileName()
                ]
                ),
                0,
                new \Exception(error_get_last()['message'])
            );
        }

        if (($ast = $this->parser->parse($content)) === null) {
            throw new \RuntimeException(strtr('Could not parse AST of class file %filename%, aborting.', ['%filename%' =>$classContext->getFileName()]));
        }

        $traverser->traverse($ast);

        $context = $nameResolver->getNameContext();

        $fqcn = $context->getResolvedClassName(new Name($name));

        return $fqcn->toString();
    }

    private function guessType(
        string $type,
        ?string $iterated,
        bool $isArray,
        bool $isCollection,
        \ReflectionClass $class
    ) {
        if ($isArray) {
            if ($iterated === null) {
                return new ArrayTypeMetadata();
            }

            return new ListTypeMetadata(
                in_array($iterated, Type::$builtInTypes) ?
                    $this->builtInType($iterated) :
                    $this->classReferenceType($this->detectFQCN($iterated, $class))
            );
        }

        if ($isCollection && $iterated !== null) {
            if (in_array($type, Type::$iterable)) {
                if (in_array($iterated, Type::$builtInTypes)) {
                    return new ListTypeMetadata(
                        $this->builtInType($iterated)
                    );
                }

                return new ListTypeMetadata(
                    $this->classReferenceType($this->detectFQCN($iterated, $class))
                );
            }

            if (in_array($iterated, Type::$builtInTypes)) {
                return new CollectionTypeMetadata(
                    $this->classReferenceType($type),
                    $this->builtInType($iterated)
                );
            }

            return new CollectionTypeMetadata(
                $this->classReferenceType($type),
                $this->classReferenceType($this->detectFQCN($iterated, $class))
            );
        }

        return in_array($type, Type::$builtInTypes) ?
            $this->builtInType($type) :
            $this->classReferenceType($this->detectFQCN($type, $class));
    }
}
