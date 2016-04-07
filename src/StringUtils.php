<?php namespace BuildR\Utils;

/**
 * Utility function for string analysis
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
class StringUtils {

    /**
     * Determines that the given string starts with the
     * given substring
     *
     * @param string $input
     * @param string $match
     *
     * @return bool
     */
    public static function startsWith($input, $match) {
        return ($match !== '' && mb_strpos($input, $match) === 0);
    }

    /**
     * Determines that the given string ends with the
     * given substring
     *
     * @param string $input
     * @param string $match
     *
     * @return bool
     */
    public static function endsWith($input, $match) {
        return ((string) $match === mb_substr($input, (mb_strlen($match) * -1)));
    }

    /**
     * Determines that the input string contains the
     * given substring.
     *
     * @param string $input
     * @param string $match
     *
     * @return bool
     */
    public static function contains($input, $match) {
        return (mb_strpos($input, $match, 0) !== FALSE);
    }

    /**
     * At this time PHP MBString extension does not have a mulibyte version
     * of the PHP's ucfirst() method. This is a simple implementation.
     *
     * @param string $input
     *
     * @return string
     */
    public static function multiByteUcfirst($input) {
        $firstChar = mb_strtoupper(mb_substr($input, 0, 1));
        $remaining = mb_substr($input, 1, mb_strlen($input));

        return $firstChar . $remaining;
    }

    /**
     *At this time PHP MBString extension does not have a mulibyte version
     * of the PHP's ucwords() method. This is a simple implementation.
     *
     * This function has a very big limitation against PHP native implementation,
     * this function only split string trough spaces instead of any whitespace
     * character
     *
     * @param $input
     */
    public static function multiByteUcwords($input) {
        $parts = explode(' ', $input);
        $result = array_map(self::class . '::multiByteUcfirst', $parts);

        return implode(' ', $result);
    }

}
