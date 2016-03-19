<?php namespace BuildR\Utils\Extension;

/**
 * Define an utility object extension
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package Utils
 * @subpackage Extension
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Utils/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Utils
 */
interface ObjectExtensionInterface {

    /**
     * Returns an array that contains all method that this extension can provide
     * The returnsRaw member of the method meta-data represent the return type.
     *
     * If the returnsRaw is FALSE the result wrapped with tha parent object (eg. StringObject),
     * if TRUE the raw result will be returnd
     *
     * Example:
     * ```php
     * return [
     *     'toLower' => ['returnsRaw' => FALSE],
     *     'toUpper' => ['returnsRaw' => FALSE],
     *     'isUpper' => ['returnsRaw' => TRUE],
     * ]
     * ```
     *
     * @return array
     */
    public function defineMethods();

    /**
     * Determines that the current extension has the given method
     *
     * @param string $methodName
     *
     * @return bool
     */
    public function hasMethod($methodName);

    /**
     * Determines that the given method result nedds to be returned as raw or not
     *
     * @param string $methodName
     *
     * @return bool
     */
    public function methodReturnedRawResult($methodName);

    /**
     * Run the given method
     *
     * The returned array has two members (rawResult, result)
     *
     * @param string $methodName The method name
     * @param mixed $startingValue The current value of the utility object
     * @param array $additionalArguments Additional method arguments
     *
     * @return array
     */
    public function runMethod($methodName, $startingValue, array $additionalArguments);

}
