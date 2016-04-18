<?php namespace BuildR\Utils\Enumeration\Exception;

use BuildR\Foundation\Exception\Exception;

class EnumerationException extends Exception {

    const MESSAGE_INVALID_VALUE = 'This enumeration is not contains any constant like: %s';

    const MESSAGE_INVALID_KEY_TYPE = 'The key must be a string! %s given!';

    public static function invalidValue($value) {
        return self::createByFormat(self::MESSAGE_INVALID_VALUE, [$value]);
    }

    public static function invalidKeyType($keyType) {
        return self::createByFormat(self::MESSAGE_INVALID_KEY_TYPE, [$keyType]);
    }

}
