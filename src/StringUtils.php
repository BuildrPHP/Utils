<?php namespace BuildR\Utils;

/**
 * Utility function for string analysis
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package Utils
 *
 * @copyright    Copyright 2015, Zoltán Borsos.
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
        return ((string) $match === substr($input, -strlen($match)));
    }

}
