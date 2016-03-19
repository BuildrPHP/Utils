<?php namespace BuildR\Utils\Extension;

/**
 * Define an utility object tha can be able to load
 * additional extensions and run method that extension
 * will provide.
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
interface ExtensionReceiverInterface {

    /**
     * This magic method called when on object called with a non-know method
     *
     * @param string $name This will be the method name can be run
     * @param array $arguments Additional arguments for method
     *
     * @return mixed
     */
    public function __call($name, $arguments);

    /**
     * @return string The fully qualified class nam of the extension interface that this object can receive
     */
    public function shouldReceiveType();

    /**
     * Returns the object current value for processing
     *
     * @return mixed
     */
    public function getCurrentValue();

    /**
     * Makes the post processing based on the method result.
     * The array contains two members (isRaw, result)
     *
     * isRaw is indicates that the result can be returned as parent object (eg. StringObject)
     * or must be returned as raw.
     *
     * The result member is holding the raw result from the extension method
     *
     * @param array $result
     *
     * @return mixed
     */
    public function processResult(array $result);

    /**
     * Loads the extension into the current object. Returns a boolean to indicate
     * extension loading status
     *
     * @param \BuildR\Utils\Extension\ObjectExtensionInterface $extension
     *
     * @return bool
     */
    public function loadExtension(ObjectExtensionInterface $extension);

    /**
     * Determines that the given extension is already loaded or not
     *
     * @param \BuildR\Utils\Extension\ObjectExtensionInterface $extension
     *
     * @return bool
     */
    public function isExtensionLoaded(ObjectExtensionInterface $extension);

    /**
     * Returns all loaded extension class name as an array.
     * If no extension is loaded this method returns an empty array
     *
     * @return array
     */
    public function getAllLoadedExtension();
}
