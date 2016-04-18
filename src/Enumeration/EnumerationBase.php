<?php namespace BuildR\Utils\Enumeration;

use \ReflectionClass;
use \Countable;
use BuildR\Foundation\Object\StringConvertibleInterface;
use BuildR\Utils\Enumeration\Exception\EnumerationException;

class EnumerationBase implements StringConvertibleInterface, Countable {

    public $value;

    private static $cache = [];

    public function __construct($value) {
        if(!$this->isValid($value)) {
            throw EnumerationException::invalidValue($value);
        }

        $this->value = $value;
    }

    public function isValid($value) {
        return (bool) in_array($value, self::toArray());
    }

    public function getValue() {
        return $this->value;
    }

    public static function toArray() {
        $enumClass = get_called_class();

        if(!array_key_exists($enumClass, self::$cache)) {
            $reflector = new ReflectionClass($enumClass);
            self::$cache[$enumClass] = $reflector->getConstants();
        }

        return self::$cache[$enumClass];
    }

    public static function getKeys() {
        return array_keys(self::toArray());
    }

    public static function isValidKey($key) {
        if(!is_string($key)) {
            throw EnumerationException::invalidKeyType(gettype($key));
        }

        return array_key_exists($key, self::toArray());
    }

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

    // ===================================
    // Countable interface implementation
    // ===================================

    /**
     * {@inheritdoc}
     */
    public function count() {
        return count(self::toArray());
    }

}
