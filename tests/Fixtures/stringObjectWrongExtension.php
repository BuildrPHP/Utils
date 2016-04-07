<?php namespace BuildR\Utils\Tests\Fixtures;

class stringObjectWrongExtension implements DummyObjectExtensionInterface {
    
    /**
     * {@inheritDoc}
     */
    public function defineMethods() {
        return TRUE;
    }

    /**
     * {@inheritDoc}
     */
    public function hasMethod($methodName) {
        return TRUE;
    }

    /**
     * {@inheritDoc}
     */
    public function methodReturnedRawResult($methodName) {
        return TRUE;
    }

    /**
     * {@inheritDoc}
     */
    public function runMethod($methodName, $startingValue, array $additionalArguments) {
        return TRUE;
    }
    
}
