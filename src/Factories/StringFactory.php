<?php namespace BuildR\Utils\Factories;

use BuildR\Foundation\Exception\InvalidArgumentException;
use BuildR\Foundation\Object\StringConvertibleInterface;
use BuildR\Utils\StringObject;

/**
 * Basic factory class for flexible stringObject creation
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package Utils
 * @subpackage Factories
 *
 * @copyright    Copyright 2015, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Utils/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Utils
 */
class StringFactory {

    /**
     * Creates a new stringObject class from the given value.
     * If the given value is an object and is string convertible the object
     * will be converted to string, before consumed.
     *
     * @param string $string
     *
     * @return \BuildR\Utils\StringObject
     *
     * @throws \BuildR\Foundation\Exception\InvalidArgumentException
     */
    public static function create($string) {
        if(is_array($string)) {
            throw new InvalidArgumentException('Arrays cannot be casted to string!');
        }

        if(is_object($string) &&
            !(($string instanceof StringConvertibleInterface) || (method_exists($string, '__toString')))) {
            throw new InvalidArgumentException('The given value is an object but cant converted to string!');
        }

        $value = (string) $string;
        return new StringObject($value);
    }

}
