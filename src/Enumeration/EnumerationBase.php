<?php namespace BuildR\Utils\Enumeration;

use \ReflectionClass;
use BuildR\Foundation\Object\StringConvertibleInterface;
use BuildR\Utils\Enumeration\Exception\EnumerationException;

/**
 * Enumeration support for PHP
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package Utils
 * @subpackage Enumeration
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Utils/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Utils
 */
class EnumerationBase implements StringConvertibleInterface {

    /**
     * @type mixed
     */
    public $value;

    /**
     * @type array
     */
    private static $cache = [];

    /**
     * EnumerationBase constructor
     *
     * @param mixed $value
     *
     * @throws \BuildR\Utils\Enumeration\Exception\EnumerationException
     */
    public function __construct($value) {
        if(!$this->isValid($value)) {
            throw EnumerationException::invalidValue($value);
        }

        $this->value = $value;
    }

    /**
     * Determines that the current value in the enumeration is valid.
     *
     * @param mixed $value
     *
     * @return bool
     */
    protected function isValid($value) {
        return (bool) in_array($value, self::toArray());
    }

    /**
     * Returns the enumeration current value
     *
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Translate the current enumeration to an associative array
     *
     * @return array
     */
    public static function toArray() {
        $enumClass = get_called_class();

        if(!array_key_exists($enumClass, self::$cache)) {
            $reflector = new ReflectionClass($enumClass);
            self::$cache[$enumClass] = $reflector->getConstants();
        }

        return self::$cache[$enumClass];
    }

    /**
     * Returns an indexed array that contains all key from this enumeration as value.
     *
     * @return array
     */
    public static function getKeys() {
        return array_keys(self::toArray());
    }

    /**
     * Determines that the given key is exist in the current enumeration or not.
     *
     * @param string $key
     *
     * @return bool
     *
     * @throws \BuildR\Utils\Enumeration\Exception\EnumerationException
     */
    public static function isValidKey($key) {
        if(!is_string($key)) {
            throw EnumerationException::invalidKeyType(gettype($key));
        }

        return array_key_exists($key, self::toArray());
    }

    /**
     * Return the sie of the current enumeration
     *
     * @return int
     */
    public static function size() {
        return count(self::toArray());
    }

    /**
     * This is a proxy method. This is called when the enumeration property called as a method.
     * This method creates a new instance from the parent class with the value defined by
     * the constant.
     *
     * @param string $name The constant name
     * @param array $arguments This function not take any arguments
     *
     * @return object
     */
    public static function __callStatic($name, $arguments) {
        $calledClass = get_called_class();
        $args[] = $name;

        if(array_key_exists(EnumerationFieldDefinitionInterface::class, class_implements($calledClass))) {
            $fields = static::defineFields()[$name];
            array_unshift($fields, $args[0]);

            $args = $fields;
        }

        $reflector = new ReflectionClass($calledClass);
        return $reflector->newInstanceArgs($args);
    }
    
    // ==========================================
    // StringConvertibleInterface implementation
    // ==========================================

    /**
     * {@inheritdoc}
     */
    public function __toString() {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function toString() {
        return $this->value;
    }

}
