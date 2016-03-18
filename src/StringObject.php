<?php namespace BuildR\Utils;

use BuildR\Foundation\Exception\InvalidArgumentException;
use BuildR\Foundation\Object\StringConvertibleInterface;
use \Countable;
use \IteratorAggregate;
use \ArrayIterator;

/**
 * This object represents a string in OO format and allow nifty manipulation
 * and analysis of the provided string.
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package Utils
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Utils/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Utils
 */
class StringObject implements StringConvertibleInterface, Countable, IteratorAggregate {

    /**
     * @type string
     */
    private $string;

    /**
     * StringObject constructor.
     *
     * @param $string
     *
     * @throws \BuildR\Foundation\Exception\InvalidArgumentException
     */
    public function __construct($string) {
        if(!is_string($string)) {
            throw new InvalidArgumentException('The given value is not a string!');
        }

        $this->string = $string;
    }

    /**
     * Appends the given substring to the current string
     *
     * @param string $substring
     *
     * @return static
     */
    public function append($substring) {
        return new static($this->string . $substring);
    }

    /**
     * Prepends the given substring to the current string
     *
     * @param string $substring
     *
     * @return static
     */
    public function prepend($substring) {
        return new static($substring . $this->string);
    }

    /**
     * Return an array where each element represent a single character from the current string
     *
     * @return array
     */
    public function chars() {
        return str_split($this->string);
    }

    /**
     * Determines the length of the current string
     *
     * @return int
     */
    public function length() {
        return mb_strlen($this->string);
    }

    /**
     * Determines that character exist in the given position
     * If the character is a whitespace this function will return
     * TRUE to indicate that index is part of the string
     *
     * @param int $index
     *
     * @return static
     */
    public function charAt($index) {
        $chars = $this->chars();
        $char = (isset($chars[$index])) ? $chars[$index] : '';

        return new static($char);
    }

    /**
     * Format the string to lowercase
     *
     * @return static
     */
    public function toLower() {
        return new static(mb_strtolower($this->string));
    }

    /**
     * Format the string to uppercase
     *
     * @return static
     */
    public function toUpper() {
        return new static(mb_strtoupper($this->string));
    }

    /**
     * Determines that the current string starts with
     * the given substring
     *
     * @param string $match
     *
     * @return bool
     */
    public function startsWith($match) {
        return StringUtils::startsWith($this->string, $match);
    }

    /**
     * Determines that the current string ends with
     * the given substring
     *
     * @param string $match
     *
     * @return bool
     */
    public function endsWith($match) {
        return StringUtils::endsWith($this->string, $match);
    }

    /**
     * Determines that the given string contains the
     * given substring
     *
     * @param string $match
     *
     * @return bool
     */
    public function contains($match) {
        return StringUtils::contains($this->string, $match);
    }

    /**
     * Determines that the current string contains ALL of the
     * given substring(s)
     *
     * @param array $matches
     *
     * @return bool
     */
    public function containsAll(array $matches = []) {
        foreach($matches as $match) {
            if(!StringUtils::contains($this->string, $match)) {
                return FALSE;
            }
        }

        return TRUE;
    }

    /**
     * Determines that the current string contains ANY of the
     * given substring(s)
     *
     * @param array $matches
     *
     * @return bool
     */
    public function containsAny(array $matches = []) {
        foreach($matches as $match) {
            if(StringUtils::contains($this->string, $match)) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Returns the defined part of the current string
     *
     * @param int $start Tha starting character (If -1 starts from the end)
     * @param int $length
     *
     * @return static
     */
    public function substring($start, $length = PHP_INT_MAX) {
        return new static(mb_substr($this->string, $start, $length));
    }

    /**
     * Returns the firs X character from the string. If the provided number higher
     * tha the string length the full string will be returned but not more.
     *
     * @param int $charCount
     *
     * @return static
     */
    public function first($charCount) {
        if($charCount <= 0) {
            return new static('');
        }

        return new static($this->substring(0, (int) $charCount));
    }

    /**
     * Returns the last X character from the current string
     *
     * @param int $charCount
     *
     * @return static
     */
    public function last($charCount) {
        if($charCount <= 0) {
            return new static('');
        }

        return new static($this->substring(($charCount * -1)));
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

    // =========================
    // Countable Implementation
    // =========================

    /**
     * {@inheritDoc}
     */
    public function count() {
        return $this->length();
    }

    // =============================
    // ArrayIterator Implementation
    // =============================

    /**
     * {@inheritDoc}
     */
    public function getIterator() {
        return new ArrayIterator($this->chars());
    }

}
