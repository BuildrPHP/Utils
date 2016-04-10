---
currentMenu: StringObject
baseUrl: ..
---

# StringObject

This class provide a handy way to work with strings in PHP. This calls wraps-up
a raw string type and give an easy to use API.

This object is **immutable**, that means if a method returns an other `StringObject`
the returned object is a **new** object.

If a method returns a `string` type is always presented as `StringObject`.

## Multi-byte support

All function designed to have multi-byte support.

## Implemented interfaces

 - `\Countable`
 - `\IteratorAggregate`
 - `\BuildR\Foundation\Object\StringConvertibleInterface`

## Method summary

### Transformation methods

```php
//Removes these whitespace characters from the input: \r, \n, \t, \0
removeWhitespace(): \BuildR\Utils\StringObject

//Appends the input string to the current value
append($input): \BuildR\Utils\StringObject

//Prepends the input string to the current value
prepend($input): \BuildR\Utils\StringObject

//Transform the string to lowercase
toLower(): \BuildR\Utils\StringObject

//Transform the string to uppercase
toUpper(): \BuildR\Utils\StringObject

//Make the string first character uppercase. Does not touch any other character
ucfirst(): \BuildR\Utils\StringObject

//Transform every word first character to uppercase in the current string
ucwords(): \BuildR\Utils\StringObject

//Returns the specified part of the current input
substring(int $start, int $length): \BuildR\Utils\StringObject

//Returns the first X character of the current input
first(int $count): \BuildR\Utils\StringObject

//Returns the last X character of the current input
last(int $count): \BuildR\Utils\StringObject

//Returns the specified segment of the current input
segement(string $delimiter, int $segement): \BuildR\Utils\StringObject

//Returns the first segment of the current input
firstSegement(string $delimiter): \BuildR\Utils\StringObject

//Returns the last segment of the current input
lastSegement(string $delimiter): \BuildR\Utils\StringObject

//Limit the string length to the given length and optionally appends any defined character
limit(int $limit = 120, string $end = '...'): \BuildR\Utils\StringObject
```

### Case transformation methods

```php
//Try to split any case method into words (cameCase, PascalCase, snake_case)
caseFree(): \BuildR\Utils\StringObject

//Convert camelCase and PascalCase string into words
splitCamelCase(): \BuildR\Utils\StringObject

//Convert snake_case string into words
splitSnakeCase(): \BuildR\Utils\StringObject

//Converts the current string Title Case
toTitleCase(): \BuildR\Utils\StringObject

//Converts the current string to snake_case
toSnakeCase(): \BuildR\Utils\StringObject

//Converts the current string to PascalCase
toPascalCase(): \BuildR\Utils\StringObject

//Converts the current string to camelCase
toCamelCase(): \BuildR\Utils\StringObject
```

### Informational methods
```php
//Return an array that contains all characters from the current string
chars(): array

//Returns the length of the current string
length(): int
count(): int

//Returns the character at the current index. If the index is greater than the length
//of the string an empty string will be returned
charAt(int $index): \BuildR\Utils\StringObject

//Determines that the current string is starting with the given needle
startsWith(string $match): bool

//Determines that the current string is ends with the given needle
endsWith(string $match): bool

//Determines that the current string contains the given needle
contains(string $match): bool

//Determines that the current string contains all the defined needles
containsAll(array $matches): bool

//Determines that the current string contains any of the defined needles
containsAny(array $matches): bool

//Split the string using the given delimiter, and execute the
//callback function on all pieces
map(string $delimiter, callable $callback): void

//Split the string using the given delimiter and return pieces as array
split(string $delimiter = ' '): array
```
