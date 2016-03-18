<?php namespace BuildR\Utils;

use BuildR\Foundation\Exception\InvalidArgumentException;
use BuildR\Foundation\Object\StringConvertibleInterface;

class StringObject implements StringConvertibleInterface {

    /**
     * @type string
     */
    private $string;

    public function __construct($string) {
        if(!is_string($string)) {
            throw new InvalidArgumentException('The given value is not a string!');
        }

        $this->string = $string;
    }

    public function append($substring) {
        return new static($this->string . $substring);
    }

    public function prepend($substring) {
        return new static($substring . $this->string);
    }

    public function chars() {
        return str_split($this->string);
    }

    public function charAt($index) {
        $chars = $this->chars();
        $char = (isset($chars[$index])) ? $chars[$index] : '';

        return new static($char);
    }

    public function toLower() {
        return new static(mb_strtolower($this->string));
    }

    public function toUpper() {
        return new static(mb_strtoupper($this->string));
    }

    public function startsWith($match) {
        return StringUtils::startsWith($this->string, $match);
    }

    public function endsWith($match) {
        return StringUtils::endsWith($this->string, $match);
    }

    //===========================================
    // StringConvertibleInterface Implementation
    //===========================================

    /**
     * {@inheritDoc}
     */
    public function __toString() {
        return $this->string;
    }

    /**
     * {@inheritDoc}
     */
    public function toString() {
        return $this->string;
    }

}
