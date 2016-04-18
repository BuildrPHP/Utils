<?php namespace BuildR\Utils\Tests\Unit\Enumeration;

use BuildR\Utils\Enumeration\Exception\EnumerationException;
use BuildR\Utils\Tests\Fixtures\Enumeration\HTTPMethod;

class EnumerationTest extends \PHPUnit_Framework_TestCase {

    /**
     * @type \BuildR\Utils\Tests\Fixtures\Enumeration\HTTPMethod
     */
    protected $enumeration;

    public function setUp() {
        $this->enumeration = HTTPMethod::GET();

        parent::setUp();
    }

    public function tearDown() {
        unset($this->enumeration);

        parent::tearDown();
    }

    public function wrongKeyValidationProvider() {
        return [
            [FALSE, 'The key must be a string! boolean given!'],
            [2.8, 'The key must be a string! double given!'],
            [7E-10, 'The key must be a string! double given!'],
            [243, 'The key must be a string! integer given!'],
            [NULL, 'The key must be a string! NULL given!'],
            [[], 'The key must be a string! array given!'],
        ];
    }

    public function wrongConstructorParameterProvider() {
        return [
            ['PUT', 'This enumeration is not contains any constant like: PUT'],
            [FALSE, 'This enumeration is not contains any constant like: '],
            [150, 'This enumeration is not contains any constant like: 150'],
            [NULL, 'This enumeration is not contains any constant like: '],
        ];
    }

    /**
     * @dataProvider wrongKeyValidationProvider
     */
    public function testIsThrowsExceptionWhenCalledValidationWithNonValidInput($type, $exString) {
        $this->expectException(EnumerationException::class);
        $this->expectExceptionMessage($exString);

        HTTPMethod::isValidKey($type);
    }

    /**
     * @dataProvider wrongConstructorParameterProvider
     */
    public function testIsThrowsAnExceptionWhenConstructedWithUnknownValue($value, $exString) {
        $this->expectException(EnumerationException::class);
        $this->expectExceptionMessage($exString);

        new HTTPMethod($value);
    }

    public function testIsReturnsEnumerationAsValidArray() {
        $expected = [
            'GET' => 'GET',
            'POST' => 'POST',
        ];

        $result = HTTPMethod::toArray();

        $this->assertCount(count($expected), $result);
        $this->assertEquals($expected, $result);
        $this->assertArrayHasKey('GET', $result);
    }

    public function testItReturnsTheEnumerationKeysProperly() {
        $expected = ['GET', 'POST'];

        $result = HTTPMethod::getKeys();

        $this->assertCount(count($expected), $result);
        $this->assertEquals($expected, $result);
    }

    public function testIsProperlyValidatesKeys() {
        $this->assertTrue(HTTPMethod::isValidKey('GET'));
        $this->assertFalse(HTTPMethod::isValidKey(''));
        $this->assertFalse(HTTPMethod::isValidKey('PUT'));
    }

    public function testItReturnsValidInstances() {
        $this->assertInstanceOf(HTTPMethod::class, $this->enumeration);
    }

    public function testIsCountTheEnumerationLengthCorrectly() {
        $this->assertTrue(is_int(HTTPMethod::count()));
        $this->assertEquals(2, HTTPMethod::count());
    }

    public function testInstancesCanReturnsTheCorrectValue() {
        $this->assertEquals('GET', $this->enumeration->getValue());
    }

    public function testInstancesCanValidateValues() {
        $this->assertTrue($this->enumeration->isValid('GET'));
        $this->assertTrue($this->enumeration->isValid('POST'));
        $this->assertFalse($this->enumeration->isValid('NON_EXIST'));
    }

    public function testItConvertsToStringCorrectly() {
        $this->assertEquals('GET', $this->enumeration->__toString());
    }
}
