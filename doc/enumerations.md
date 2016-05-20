---
currentMenu: enumeration-usage
baseUrl: ..
---

# Using enumerations

Because PHP does not have enumeration type, this package defines the `AbstractEnumeration` class
that try to solve this problem.

```php
class Planet extends AbstractEnumeration {

    const ERATH = 'EARTH';

    const MERCURY = 'MERCURY';

    /* ... */

}
```
