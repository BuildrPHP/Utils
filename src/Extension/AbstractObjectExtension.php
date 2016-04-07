<?php namespace BuildR\Utils\Extension;

/**
 * AbstractObjectExtension
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
abstract class AbstractObjectExtension implements ObjectExtensionInterface {

    /**
     * {@inheritdoc}
     */
    public function hasMethod($methodName) {
        return array_key_exists($methodName, $this->defineMethods());
    }

    /**
     * {@inheritdoc}
     */
    public function methodReturnedRawResult($methodName) {
        if($this->hasMethod($methodName)) {
            return (bool) $this->defineMethods()[$methodName]['returnsRaw'];
        }

        return TRUE; //@codeCoverageIgnore
    }

    /**
     * {@inheritdoc}
     */
    public function runMethod($methodName, $startingValue, array $additionalArguments) {
        $args = $additionalArguments;
        array_unshift($args, $startingValue);

        $methodReturnsAsRaw = $this->methodReturnedRawResult($methodName);
        $result = call_user_func_array([$this, $methodName], $args);

        return ['result' => $result, 'rawResult' => $methodReturnsAsRaw];
    }
}
