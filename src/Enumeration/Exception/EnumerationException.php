<?php namespace BuildR\Utils\Enumeration\Exception;

use BuildR\Foundation\Exception\Exception;

/**
 * This exception will thrown when an enumeration called with incorrect data
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package Utils
 * @subpackage Enumeration\Exception
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://raw.githubusercontent.com/BuildrPHP/Utils/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Utils
 *
 * @codeCoverageIgnore
 */
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
