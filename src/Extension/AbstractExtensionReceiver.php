<?php namespace BuildR\Utils\Extension;

use BuildR\Foundation\Exception\InvalidArgumentException;

/**
 * This object represents a string in OO format and allow nifty manipulation
 * and analysis of the provided string.
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
abstract class AbstractExtensionReceiver implements ExtensionReceiverInterface {

    /**
     * @type \BuildR\Utils\Extension\ObjectExtensionInterface[]
     */
    protected $extensions = [];

    /**
     * {@inheritdoc}
     */
    public function __call($name, $arguments) {
        foreach($this->extensions as $extension) {
            if($extension->hasMethod($name)) {
                $result = $extension->runMethod($name, $this->getCurrentValue(), $arguments);
                return $this->processResult($result);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function loadExtension(ObjectExtensionInterface $extension) {
        $type = $this->shouldReceiveType();

        if(!($extension instanceof $type)) {
            $message = 'This object only take ' . $type . ' extensions! Given type: ' . gettype($extension);
            throw new InvalidArgumentException($message);
        }

        $extClass = get_class($extension);
        $this->extensions[$extClass] = $extension;
    }

    /**
     * {@inheritDoc}
     */
    public function isExtensionLoaded(ObjectExtensionInterface $extension) {
        return array_key_exists(get_class($extension), $this->extensions);
    }

    /**
     * {@inheritDoc}
     */
    public function getAllLoadedExtension() {
        return array_keys($this->extensions);
    }

}
