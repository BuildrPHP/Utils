<?php namespace BuildR\Utils\Tests\Unit\Factories;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\TestTools\DataSetLoader\DataSetLoaderFactory;
use BuildR\Utils\Factories\StringFactory;
use BuildR\Utils\StringObject;

class StringObjectTest extends BuildR_TestCase {

    const TEST_FILE = TESTS_DATA_SET_LOCATION . DS . 'StringObject.xml';

    public function providerInvalidConstructorParam() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'invalidConstructorParameterGroup')->getResult();
    }

    public function providerAppendFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'appendGroup')->getResult();
    }

    public function providerPrependFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'prependGroup')->getResult();
    }

    public function providerCharsFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'charsGroup')->getResult();
    }

    public function providerLengthFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'lengthGroup')->getResult();
    }

    /**
     * @dataProvider providerInvalidConstructorParam
     */
    public function testItThrowsExceptionWhenInputIsNotString($input, $expectedException, $expectedExceptionMessage) {
        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);

        (new StringObject($input));
    }

    /**
     * @dataProvider providerAppendFunction
     */
    public function testAppendFunctionWorksCorrectly($input, $append, $expectedResult) {
        $instance = StringFactory::create($input);
        $result = $instance->append($append);

        $this->assertEquals($expectedResult, $result->toString());
    }

    /**
     * @dataProvider providerPrependFunction
     */
    public function testPrependFunctionWorksCorrectly($input, $prepend, $expectedResult) {
        $instance = StringFactory::create($input);
        $result = $instance->prepend($prepend);

        $this->assertEquals($expectedResult, $result->toString());
    }

    /**
     * @dataProvider providerCharsFunction
     */
    public function testCharsFunctionWorksCorrectly($input, $expectedResult) {
        $instance = StringFactory::create($input);
        $chars = $instance->chars();

        $this->assertTrue(is_array($chars));
        $this->assertEquals($expectedResult, $chars);
    }

    /**
     * @dataProvider providerLengthFunction
     */
    public function testLengthFunctionWorksCorrectly($input, $expectedResult, $expectedWoLineBreaks) {
        $instance = StringFactory::create($input);

        $this->assertEquals($expectedResult, $instance->length(FALSE));
        $this->assertEquals($expectedWoLineBreaks, $instance->length(TRUE));
    }

}
