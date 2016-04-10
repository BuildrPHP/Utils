<?php namespace BuildR\Utils;

use BuildR\Foundation\Exception\InvalidArgumentException;
use BuildR\Foundation\Object\StringConvertibleInterface;
use BuildR\Utils\Extension\AbstractExtensionReceiver;
use BuildR\Utils\Extension\StringObjectExtensionInterface;
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
class StringObject
    extends AbstractExtensionReceiver
    implements StringConvertibleInterface, Countable, IteratorAggregate {

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
     * Remove all whitespace character from the given string
     *
     * @return \BuildR\Utils\StringObject
     */
    public function removeWhitespace() {
        $result = str_replace(["\\r", "\\n", "\\t", "\\0"], '', $this->string);

        return $this->createClone($result);
    }

    /**
     * Appends the given substring to the current string
     *
     * @param string $substring
     *
     * @return \BuildR\Utils\StringObject
     */
    public function append($substring) {
        $newValue = $this->string . $substring;

        return $this->createClone($newValue);
    }

    /**
     * Prepends the given substring to the current string
     *
     * @param string $substring
     *
     * @return \BuildR\Utils\StringObject
     */
    public function prepend($substring) {
        $newValue = $substring . $this->string;

        return $this->createClone($newValue);
    }

    /**
     * Return an array where each element represent a single character from the current string
     *
     * @return array
     */
    public function chars() {
        $string = $this->string;

        return preg_split('/(?<!^)(?!$)/u', $string);
    }

    /**
     * Determines the length of the current string
     *
     * @return int
     */
    public function length() {
        $string = $this->string;

        return mb_strlen($string);
    }

    /**
     * Determines that character exist in the given position
     * If the character is a whitespace this function will return
     * TRUE to indicate that index is part of the string
     *
     * This function counts characters from 1
     *
     * @param int $index
     *
     * @return \BuildR\Utils\StringObject
     */
    public function charAt($index) {
        $index = $index - 1;
        $chars = $this->chars();
        $char = (isset($chars[$index])) ? $chars[$index] : '';

        return $this->createClone($char);
    }

    /**
     * Format the string to lowercase
     *
     * @return \BuildR\Utils\StringObject
     */
    public function toLower() {
        $newValue = mb_strtolower($this->string);

        return $this->createClone($newValue);
    }

    /**
     * Format the string to uppercase
     *
     * @return \BuildR\Utils\StringObject
     */
    public function toUpper() {
        $newValue = mb_strtoupper($this->string);

        return $this->createClone($newValue);
    }

    /**
     * Format the current string first character to uppercase.
     * Leave any other character untouched
     *
     * @return \BuildR\Utils\StringObject
     *
     * @codeCoverageIgnore
     */
    public function ucfirst() {
        $result = StringUtils::multiByteUcfirst($this->string);

        return $this->createClone($result);
    }

    /**
     * Split the current string trough spaces and makes every words first
     * character uppercase. Leave any other character untouched
     *
     * @return \BuildR\Utils\StringObject
     *
     * @codeCoverageIgnore
     */
    public function ucwords() {
        $result = StringUtils::multiByteUcwords($this->string);

        return $this->createClone($result);
    }

    /**
     * Determines that the current string starts with
     * the given substring
     *
     * @param string $match
     *
     * @return bool
     *
     * @codeCoverageIgnore
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
     *
     * @codeCoverageIgnore
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
     *
     * @codeCoverageIgnore
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
     * @param int|NULL $length
     *
     * @return \BuildR\Utils\StringObject
     */
    public function substring($start, $length = NULL) {
        //TODO: Fix to PHP #42101
        if($length === NULL) {
            $newValue = mb_substr($this->string, $start);
        } else {
            $newValue = mb_substr($this->string, $start, $length);
        }

        return $this->createClone($newValue);
    }

    /**
     * Returns the firs X character from the string. If the provided number higher
     * tha the string length the full string will be returned but not more.
     *
     * @param int $charCount
     *
     * @return \BuildR\Utils\StringObject
     */
    public function first($charCount) {
        if($charCount <= 0) {
            return $this->createClone('');
        }

        $newValue = $this->substring(0, (int) $charCount);

        return $this->createClone($newValue);
    }

    /**
     * Returns the last X character from the current string
     *
     * @param int $charCount
     *
     * @return \BuildR\Utils\StringObject
     */
    public function last($charCount) {
        if($charCount <= 0) {
            return $this->createClone('');
        }

        $newValue = $this->substring(($charCount * -1));

        return $this->createClone($newValue);
    }

    /**
     * Iterates over parts of the string. The current string split through
     * the given delimiter and the closure will be called on all elements.
     *
     * The closer takes two arguments:
     *  - (string) $part The current part of the string
     *  - (string) $delimiter the delimiter passed to this function
     *
     * @param string $delimiter
     * @param callable $callback
     */
    public function map($delimiter, callable $callback) {
        $parts = $this->split($delimiter);

        foreach($parts as $part) {
            call_user_func_array($callback, [$part, $delimiter]);
        }
    }

    /**
     * Split string along the delimiter
     *
     * @param string $delimiter
     *
     * @return array
     */
    public function split($delimiter = ' ') {
        $delimiter = (empty($delimiter)) ? ' ' : $delimiter;

        return explode($delimiter, $this->string);
    }

    /**
     * Split the string along the delimiter and returns
     * the given index from the segments
     *
     * @param string $delimiter
     * @param int $index
     *
     * @return \BuildR\Utils\StringObject
     */
    public function segment($delimiter, $index) {
        $parts = $this->split($delimiter);
        $returnValue = (isset($parts[$index - 1])) ? $parts[$index - 1] : '';

        return $this->createClone($returnValue);
    }

    /**
     * Split string along the delimiter and
     * return the last segment
     *
     * @param string $delimiter
     *
     * @return \BuildR\Utils\StringObject
     *
     * @codeCoverageIgnore
     */
    public function lastSegment($delimiter) {
        $parts = $this->split($delimiter);
        $returnValue = end($parts);

        return $this->createClone($returnValue);
    }

    /**
     * Split the string along the delimiter and
     * returns the first segment
     *
     * @param string $delimiter
     *
     * @return \BuildR\Utils\StringObject
     *
     * @codeCoverageIgnore
     */
    public function firstSegment($delimiter) {
        $parts = $this->split($delimiter);
        $returnValue = current($parts);

        return $this->createClone($returnValue);
    }

    /**
     * Limit the length of the current string. If the current string is
     * longer tha the given limit chopped down to limit and the end
     * substring will be concatenated.
     *
     * @param int $limit
     * @param string $end
     *
     * @return \BuildR\Utils\StringObject
     */
    public function limit($limit = 120, $end = '...') {
        $returnValue = $this->string;

        if($this->length() > $limit) {
            $returnValue = rtrim((string) $this->first($limit)->toString()) . $end;
        }

        return $this->createClone($returnValue);
    }

    /**
     * Split down cameCase or PascalCase strings
     *
     * Example:
     * helloWorld -> hello World
     * ExampleHelloWorld -> ExampleHelloWorld
     *
     * @return \BuildR\Utils\StringObject
     */
    public function splitCamelCase() {
        preg_match_all('/((?:^|[\p{Lu}])[\p{Ll}_]+)/mu', $this->string, $matches);
        $returnValue = implode(' ', $matches[0]);

        return $this->createClone($returnValue);
    }

    /**
     * Split snake_case string.
     *
     * Example
     * hello_world -> hello world
     *
     * @return \BuildR\Utils\StringObject
     */
    public function splitSnakeCase() {
        $parts = $this->split('_');
        $returnValue = implode(' ', $parts);

        return $this->createClone($returnValue);
    }

    /**
     * Try to split any case method into words.
     * This convert the following cases into words:
     *
     *  - PascalCase
     *  - camelCase
     *  - snake_case
     *
     * Example:
     * helloExampleWorld_olah -> hello Example World olah
     *
     * @return \BuildR\Utils\StringObject
     */
    public function caseFree() {
        $returnValue = $this->splitSnakeCase()->splitCamelCase();

        return $this->createClone((string) $returnValue);
    }

    /**
     * Convert current string to 'Title Case'
     *
     * Example:
     * 'hello world example' -> 'Hello World Example'
     *
     * @return \BuildR\Utils\StringObject
     */
    public function toTitleCase() {
        $returnValue = mb_convert_case((string) $this->toLower(), MB_CASE_TITLE);

        return $this->createClone($returnValue);
    }

    /**
     * Convert current string to snake_case
     *
     * @return \BuildR\Utils\StringObject
     */
    public function toSnakeCase() {
        $newValue = implode('_', $this->split(' '));

        return $this->createClone($newValue);
    }

    /**
     * Convert current string to PascalCase
     *
     * @return \BuildR\Utils\StringObject
     */
    public function toPascalCase() {
        $newValue = $this->toLower()->toTitleCase()->toString();
        $newValue = implode('', explode(' ', $newValue));

        return $this->createClone($newValue);
    }

    /**
     * Convert current string to camelCase
     *
     * @return \BuildR\Utils\StringObject
     */
    public function toCamelCase() {
        $parts = $this->toLower()->split(' ');
        $index = 0;
        $result = '';

        //Yeah, Its ugly. But fast...
        foreach($parts as $part) {
            if($index === 0) {
                $index++;
                $result .= $part;

                continue;
            }

            $result .= (string) $this->createClone($part)->ucfirst();
            $index++;
        }

        return $this->createClone($result);
    }

    /**
     * Clone the current object a set a new value (base string)
     * on the clone.
     *
     * This method allow instances immutability, but allow instances
     * to retain loaded extensions.
     *
     * @param $newValue
     *
     * @return \BuildR\Utils\StringObject
     */
    protected function createClone($newValue) {
        if($newValue instanceof StringObject) {
            $newValue == $newValue->toString();
        }

        $newInstance = clone $this;
        $newInstance->string = $newValue;

        return $newInstance;
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
     *
     * @codeCoverageIgnore
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

    // ==========================================
    // ExtensionReceiverInterface Implementation
    // ==========================================

    /**
     * {@inheritDoc}
     *
     * @internal
     */
    public function shouldReceiveType() {
        return StringObjectExtensionInterface::class;
    }

    /**
     * {@inheritDoc}
     *
     * @internal
     */
    public function getCurrentValue() {
        return $this->string;
    }

    /**
     * {@inheritDoc}
     *
     * @internal
     */
    public function processResult(array $result) {
        list($result, $isRaw) = array_values($result);

        if(!$isRaw && is_string($result)) {
            return $this->createClone($result);
        }

        return $result;
    }

}
