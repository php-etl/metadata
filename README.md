PHP Data Structures Meta
===

What is it about?
---

This component aims at describing data structures in order to help
other packages to auto-configure and handle data transformation
and data manipulation.

Installation
---

To use this package in your application, require it via composer:

```bash
composer require php-etl/metadata
```

Run the tests
---

There are PHPSpec tests declared in this package to ensure everything 
is running fine.

```bash
phpspec run
```

Use this package to read metadata of existing code
---

In order to read the metadata of existing PHP code, you may use the 
automatic type guesser. It can be initialised with the following code:

```php
<?php

use Kiboko\Component\ETL\Metadata\TypeGuesser;
use Phpactor\Docblock\DocblockFactory;
use PhpParser\ParserFactory;

$typeGuesser = new TypeGuesser\CompositeTypeGuesser(
    new TypeGuesser\Native\Php74TypeGuesser(),
    new TypeGuesser\Docblock\DocblockTypeGuesser(
        (new ParserFactory())->create(ParserFactory::ONLY_PHP7),
        new DocblockFactory()
    )
);
```

Then, use the instance as a functor to automatically discover the types metadata.

Example of a DTO class metadata fetcher:

```php
<?php

use Kiboko\Component\ETL\Metadata;
use Kiboko\Component\ETL\Metadata\TypeGuesser\TypeGuesserInterface;

/** @var TypeGuesserInterface $guesser */

class Person
{
    public string $firstName;
    public string $lastName;
    public ?string $job;
}

$classOrObject = new \ReflectionClass(\Person::class);

/** @var Metadata\ClassTypeMetadata $metadata */
$metadata = (new Metadata\ClassTypeMetadata($classOrObject->getShortName(), $classOrObject->getNamespaceName()))
    ->addProperties(...array_map(
            function(\ReflectionProperty $property) use($classOrObject, $guesser) {
                return new Metadata\PropertyMetadata(
                    $property->getName(),
                    ...$guesser($classOrObject, $property)
                );
            },
            $classOrObject->getProperties(\ReflectionProperty::IS_PUBLIC)
        )
    );
``` 

Automatic class metadata guessing
---

In order to simplify the class metadata building, there is a metadata guesser you can 
use to ease the building of metadata.

```php
<?php
use Kiboko\Component\ETL\Metadata;

/** @var Metadata\ClassMetadataBuilder $metadataBuilder */
$metadataBuilder = new Metadata\ClassMetadataBuilder(
    new Metadata\PropertyGuesser\ReflectionPropertyGuesser($typeGuesser),
    new Metadata\MethodGuesser\ReflectionMethodGuesser($typeGuesser),
    new Metadata\FieldGuesser\FieldGuesserChain(
        new Metadata\FieldGuesser\PublicPropertyFieldGuesser(),
        new Metadata\FieldGuesser\VirtualFieldGuesser()
    ),
    new Metadata\RelationGuesser\RelationGuesserChain(
        new Metadata\RelationGuesser\PublicPropertyUnaryRelationGuesser(),
        new Metadata\RelationGuesser\PublicPropertyMultipleRelationGuesser(),
        new Metadata\RelationGuesser\VirtualRelationGuesser()
    )
);

$metadata = $metadataBuilder->buildFromFQCN('FooBarBundle\\Entity\\Foo');
```

PHP version and typed properties
---

This package works from php 7.2+.

In case you are running it with a version prior to 7.4, the property
type hinting is not active and a [dummy metadata reader][dummy native] can replace 
the standard one.

Additionally, it you don't want the PHPDocs to be considered, you may use another
[dummy metadata reader][dummy phpdoc] for this specific part.

Documentation
---

To go further and see the DTO structure, check the [object reference].

[dummy phpdoc]: src/Guesser/Native/DummyTypeGuesser.php
[dummy native]: src/Guesser/Native/DummyTypeGuesser.php
[object reference]: docs/index.md