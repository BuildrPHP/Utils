<?php namespace Buildr\Utils\Tests\Fixtures;

class RawStringConvertibleObject {

    const returnValue = 'testString';

    public function __toString() {
        return self::returnValue;
    }

}
