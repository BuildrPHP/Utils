---
currentMenu: quickCreation
baseUrl: ..
---

# Quick access

If you using `StrngObject` in many places, creation of the new instances are really pain.
Use the provided factory and function to simplify this process

## Factory

### Description

The factory not only creates a new instance from `StringObject`, this also validates
and converts the input.

 - Check that the input is not an array
 - If the input is object, check for `__toString()` method or `StringConvertibleInterface` interface implementation
 - Cast any other type of input to string

### Usage

```php
$upper = StringFactory::create('test')->toUpper();
echo $upper; //echo: TEST
```

## Namespaced function

### Description

This package also provides a namespaced function
Function use also use the `StringFactory`, so this function provides same
conversion and validation.

### Usage

```php
use function BuildR\Utils\Functions\str;

$upper = str('test')->toUpper();
echo $upper; //echo: TEST
```
