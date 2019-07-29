Object Reference
===

Types metadata:

* [`ArrayTypeMetadata`]
* [`ClassReferenceMetadata`]
* [`CollectionTypeMetadata`]
* [`ListTypeMetadata`]
* [`NullTypeMetadata`]
* [`ClassTypeMetadata`]
* [`ScalarTypeMetadata`]

Class structuring objects:

* [`PropertyMetadata`]
* [`MethodMetadata`]

Function structuring objects:

* [`ArgumentMetadata`]
* [`ArgumentMetadataList`]

Array structuring objects:

* [`ArrayEntryMetadata`]

`ArgumentMetadata`
---

An implementation of `ArgumentMetadataInterface`, dedicated to unary
(non-variadic) arguments.

* public attribute `name`: the name of the argument
* public attribute `types`: an iterable of `TypeMetadataInterface`, representing
accepted argument types

Also, see [`VariadicArgumentMetadata`]

`ArgumentMetadataList`
---

An iterable object of [`ArgumentMetadata`] objects.

* public property `arguments`: an iterable of [`ArgumentMetadata`] objects

`ArrayEntryMetadata`
---

Represents an indexed array entry.

* public property `name`: the key used as index for this field
* public property `types`: an iterable of `TypeMetadataInterface`, representing
accepted entry types

`ArrayTypeMetadata`
---

Represents a native array type, also an iterable of 
[`ArrayEntryMetadata`].

* public property `entries`:  an iterable of [`ArrayEntryMetadata`] objects

`ClassReferenceMetadata`
---

Represents a class reference, generated from type hints, used to
search into a class repository for [`ClassTypeMetadata`] instances. 

* public property `name`: the short name of the class
* public property `namespace`: the namespace of the class
* magic stringify method: the fully qualified class name

`ClassTypeMetadata`
---

Represents a class structure, used to describe a class structure.

* public property `name`: the short name of the class 
* public property `namespace`: the namespace of the class
* magic stringify method: the fully qualified class name
* public property `properties`: an iterable of [`PropertyMetadata`]
* public property `methods`: an iterable of [`MethodMetadata`]

`CollectionTypeMetadata`
---

Represents an iterable class, with an inner values type enforced,
numerically indexed.

* public property `type`: a `ClassMetadataInterface` object 
(see [`ClassTypeMtadata`] and [`ClassReferenceMetadata`])
* public property `inner`: a [`TypeMetadataInterface`] object, 
representing the possible inner type

`ListTypeMetadata`
---

Represents an iterable, with an inner values type enforced,
numerically indexed. The variable type is not enforced, can be any of 
the valid types for `iterable` meta-type.

* public property `inner`: a [`TypeMetadataInterface`] object, 
representing the possible inner type

`MethodMetadata`
---

Represents the methods declaration and structure in a [`ClassTypeMetadata`].

* public property `name`: the method name as string
* public property `argumentList`: the method argument list as an [`ArgumentMetadataList`].
* public property `returnTypes`: an iterable of [`TypeMetadataInterface`], 
representing the possible return types

Also, see [`PropertyTypeMetadata`]

`NullTypeMetadata`
---

Represents a nullable return type, parameter type or property.

`PropertyMetadata`
---

Represents the properties declaration and structure in a [`ClassTypeMetadata`].

* public property `name`: the method name as string
* public property `types`: an iterable of [`TypeMetadataInterface`], 
representing the possible types

Also, see [`MethodTypeMetadata`]

`ScalarTypeMetadata`
---

Represents a native scalar type.

* public property `name`: type name

`VariadicArgumentMetadata`
---

An implementation of `ArgumentMetadataInterface`, dedicated to variadic arguments.

* public attribute `name`: the name of the argument
* public attribute `types`: an iterable of `TypeMetadataInterface`, representing
accepted argument types

Also, see [`ArgumentMetadata`]

[`ArgumentMetadata`]: #argumentmetadata
[`ArgumentMetadataList`]: #argumentmetadatalist
[`ArrayEntryMetadata`]: #arrayentrymetadata
[`ArrayTypeMetadata`]: #arraytypemetadata
[`ClassReferenceMetadata`]: #classreferencemetadata
[`CollectionTypeMetadata`]: #collectiontypemetadata
[`ListTypeMetadata`]: #listtypemetadata
[`NullTypeMetadata`]: #nulltypemetadata
[`ClassTypeMetadata`]: #classtypemetadata
[`PropertyMetadata`]: #propertymetadata
[`MethodMetadata`]: #methodmetadata
[`ScalarTypeMetadata`]: #scalartypemetadata
  