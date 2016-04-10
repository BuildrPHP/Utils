---
currentMenu: StringUtils
baseUrl: ..
---

# StringUtils

This class some **static** utility functions that used in `StringObject` but
useful in some case that you do not want to create `StringObject`.

## Method summary

```php
//Determines that the current string starts with the given needle
startsWith(string $input, string $match): bool

//Determines that the current string ends with the given needle
endsWith(strin $input, string $match): bool

//Determines that the current string contains the given needle
contains(string $input, string $match): bool

//Converts the input first character to uppercase. Leaves any other character untouched
multiByteUcfirst(string $input): string

//Converts the given input all word first character to uppercase. Leaves any other character untouched
multiByteUcwords(strin $input): string
```
