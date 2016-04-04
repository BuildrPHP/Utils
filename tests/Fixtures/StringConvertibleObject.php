<?php namespace BuildR\Utils\Tests\Fixtures;

use BuildR\Foundation\Object\StringConvertibleInterface;

class StringConvertibleObject implements StringConvertibleInterface {

    const returnValue = 'testString';

    /**
     * {@inheritDoc}
     */
    public function __toString() {
        return self::returnValue;
    }

    /**
     * {@inheritDoc}
     */
    public function toString() {
        return self::returnValue;
    }


}
