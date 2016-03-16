<?php namespace BuildR\Utils;

use BuildR\Foundation\Exception\InvalidArgumentException;
use BuildR\Foundation\Object\StringConvertibleInterface;
use BuildR\Utils\Exception\IntegrationException;
use BuildR\Utils\Integration\BuiltInStringFunctionsIntegration;

class StringObject implements StringConvertibleInterface {

    private $string;

    /**
     * @type \BuildR\Utils\Integration\BuiltInStringFunctionsIntegration
     */
    private $builtInIntegration;

    public function __construct($string) {
        if(!is_string($string)) {
            throw new InvalidArgumentException('The given value is not a string!');
        }

        $this->string = $string;
    }

    public function __call($name, $arguments) {
        if($this->builtInIntegration === NULL) {
            $this->builtInIntegration = new BuiltInStringFunctionsIntegration();
        }

        if($this->builtInIntegration->hasMethod($name)) {
            array_unshift($arguments, $this->string);
            $result = $this->builtInIntegration->run($name, $arguments);

            $newObject = clone $this;
            $newObject->string = $result;

            return $newObject;
        }

        throw IntegrationException::nonExistingMethod(get_class($this->builtInIntegration), $name);
    }

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
