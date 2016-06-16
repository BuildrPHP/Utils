<?php namespace BuildR\Utils\Tests\Unit\Enumeration;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\Utils\Tests\Fixtures\Enumeration\Planet;

class MultiFieldEnumerationTest extends BuildR_TestCase {

    public function testIsPopulateFieldsCorrectly() {
        /** @type \Buildr\Utils\Tests\Fixtures\Enumeration\Planet $mercury */
        $mercury = Planet::MERCURY();

        $this->assertEquals(3.303e+23, $mercury->mass);
        $this->assertEquals(2.4397e6, $mercury->radius);
        $this->assertEquals('MERCURY', $mercury->value);
    }

}
