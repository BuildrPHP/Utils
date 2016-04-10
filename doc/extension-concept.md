---
currentMenu: concept
baseUrl: ..
---

# Concept of the extension system

In real word you probably need specific functionality for different projects, but this package may
not offer this functionality, because the functionality you want is too project specific.

You probably ends up with a solution that creates a static helper and use this. If you do not
want to decouple from already used `StringObject` this is the system you want. Extensions
allow you to extends the base `StringObject` functionality.

# Implementation

The implementation is really simple. The base object (in this case the `StringObject`) implements
the `ExtensionReceiverInterface` that indicates the object can store extensions. The class also extends the
`AbstractExtensionReceiver` abstract class that predefine some logic for extension handling. The class only
needs to implement 2 method.

 - **shouldReceiveType()**

This method defines what type of extension this class can handle. The method must return a FQCN.
In this example the `StringObject` returns the FQCN of the `StringObjectExtensionInterface`

 - **getCurrentValue()**

This method returns the instance current base value for processing.

 - **processResult(array $result)**

This method receives an extension method result. The array contains all option and the result.
This method defines how new objects and raw results are returned.

# Defining extension methods

An object extension must implement the interface that the **receiver** defines in the
**shouldReceiveType()** method. Typically this interface also extends the `ObjectExtensionInterface`
Extension also can extends the `AbstractObjectExtension` class.

If the `AbstractObjectExtension` class is used the extension only needs the implement the `defineMethods()`
method.

## Method definition structure

The `defineMethods()` method must returns an associative array with the following structure:

```php
return [
    'methodName' => ['returnsRaw' => TRUE],
];
```

The key is the method name, and the value is an array that contains some definition about the
method return type.

If the `returnsRaw` option is `TRUE` the method result returned as the method returns. If its
set to `FALSE` the returned value wrapped around the parent object.


## Running methods

If you invoke a method on base class, the extension receives all parameter you passed.
But the parameter list is overwritten with the parent class original value.

```php
$object = StringFactory::create('test');
$object->extensionDefinedMethod('value', 'value2');
```

So, the `extensionDefinedMethod()` in the extension will receive the following list of parameters:

 - test   (The parent original value)
 - value  (Passed parameter 1)
 - value2 (Passed parameter 2)
