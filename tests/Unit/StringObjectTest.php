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

    public function providerCharAtFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'charAtGroup')->getResult();
    }

    public function providerToLowerFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'toLowerGroup')->getResult();
    }

    public function providerToUpperFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'toUpperGroup')->getResult();
    }

    public function providerRemoveWhitespaceFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'removeWhitespaceGroup')->getResult();
    }

    public function providerContainsAllFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'containsAllGroup')->getResult();
    }

    public function providerContainsAnyFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'containsAnyGroup')->getResult();
    }

    public function providerSubstringFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'substringGroup')->getResult();
    }

    public function providerFirstFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'firstGroup')->getResult();
    }

    public function providerLastFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'lastGroup')->getResult();
    }

    public function providerMapFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'mapGroup')->getResult();
    }

    public function providerSplitCamelCaseFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'splitCamelCaseGroup')->getResult();
    }

    public function providerSplitSnakeCaseFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'splitSnakeCaseGroup')->getResult();
    }

    public function providerCaseFreeFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'caseFreeGroup')->getResult();
    }

    public function providerSegmentFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'segmentGroup')->getResult();
    }

    public function providerLimitFunction() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'limitGroup')->getResult();
    }

    public function providerCaseConversionFunctions() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'caseConversionGroup')->getResult();
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
     * @dataProvider providerRemoveWhitespaceFunction
     */
    public function testRemoveWhitespaceWorksCorrectly($input, $expected) {
        $instance = StringFactory::create($input);
        $actual = $instance->removeWhitespace()->toString();

        $this->assertEquals($expected, $actual);
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
        $iterator = $instance->getIterator();

        $this->assertInstanceOf(\ArrayIterator::class, $iterator);
        $this->assertTrue(is_array($chars));
        $this->assertEquals($expectedResult, $chars);
    }

    /**
     * @dataProvider providerLengthFunction
     * @covers BuildR\Utils\StringObject::count
     */
    public function testLengthFunctionWorksCorrectly($input, $expectedResult) {
        $instance = StringFactory::create($input);

        $this->assertEquals($expectedResult, $instance->length());
    }

    /**
     * @dataProvider providerCharAtFunction
     */
    public function testCharAtFunctionWorksCorrectly($input, $position, $expected) {
        $instance = StringFactory::create($input);
        $char = $instance->charAt($position)->toString();

        $this->assertEquals($expected, $char);
    }

    /**
     * @dataProvider providerToLowerFunction
     */
    public function testToLowerFunctionWorksCorrectly($input, $expected) {
        $instance = StringFactory::create($input);
        $actual = $instance->toLower()->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerToUpperFunction
     */
    public function testToUpperFunctionWorksCorrectly($input, $expected) {
        $instance = StringFactory::create($input);
        $actual = $instance->toUpper()->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerContainsAllFunction
     */
    public function testContainsAllFunctionWorksCorrectly($input, $containedValues, $expected) {
        $instance = StringFactory::create($input);
        $result = $instance->containsAll($containedValues);

        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider providerContainsAnyFunction
     */
    public function testContainsAnyFunctionWorksCorrectly($input, $containedValues, $expected) {
        $instance = StringFactory::create($input);
        $result = $instance->containsAny($containedValues);

        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider providerSubstringFunction
     */
    public function testSubstringFunctionWorksCorrectly($input, $start, $length, $expected) {
        $instance = StringFactory::create($input);

        if($length === TRUE) {
            $result = $instance->substring($start);
        } else {
            $result = $instance->substring($start, $length);
        }

        $this->assertEquals($expected, $result->toString());
    }

    /**
     * @dataProvider providerFirstFunction
     */
    public function testFirstFunctionWorksCorrectly($input, $firstCharCount, $expected) {
        $actual = StringFactory::create($input)->first($firstCharCount)->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerLastFunction
     */
    public function testLastFunctionWorksCorrectly($input, $lastCharCount, $expected) {
        $actual = StringFactory::create($input)->last($lastCharCount)->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerMapFunction
     * @covers BuildR\Utils\StringObject::map
     * @covers BuildR\Utils\StringObject::split
     */
    public function testMapFunctionWorksCorrectly($input, $delimiter, $expCallCount, $expResultArray) {
        $result = [];
        $origDelimiter = $delimiter;
        $callCount = 0;
        $self = $this;

        StringFactory::create($input)->map(
            $delimiter,
            function($value, $delimiter) use(&$result, &$callCount, &$self, &$origDelimiter)  {
                $self->assertEquals($origDelimiter, $delimiter);
                $callCount++;
                $result[] = $value;
            }
        );

        $this->assertEquals($expCallCount, $callCount);
        $this->assertEquals($expResultArray, $result);
    }

    /**
     * @dataProvider providerSplitCamelCaseFunction
     */
    public function testCamelCaseFunctionWorksCorrectly($input, $expected) {
        $actual = StringFactory::create($input)->splitCamelCase()->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerSplitSnakeCaseFunction
     */
    public function testCamelSnakeFunctionWorksCorrectly($input, $expected) {
        $actual = StringFactory::create($input)->splitSnakeCase()->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerCaseFreeFunction
     */
    public function testCaseFreeFunctionWorksCorrectly($input, $expected) {
        $actual = StringFactory::create($input)->caseFree()->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerSegmentFunction
     * @cover BuildR\Utils\StringObject::segment
     * @cover BuildR\Utils\StringObject::firstSegment
     * @cover BuildR\Utils\StringObject::lastSegment
     */
    public function testSegmentFunctionWorksCorrectly($input, $delimiter, $segmentNo, $expected) {
        $actual = StringFactory::create($input)->segment($delimiter, $segmentNo)->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerLimitFunction
     */
    public function testLimitFunctionWorksCorrectly($input, $limit, $end, $expected) {
        $actual = StringFactory::create($input)->limit($limit, $end)->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerCaseConversionFunctions
     */
    public function testCaseConversionWorksCorrectly($input, $title, $snake, $pascal, $camel) {
        $instance = StringFactory::create($input);

        $this->assertEquals($title, $instance->toTitleCase()->toString());
        $this->assertEquals($snake, $instance->toSnakeCase()->toString());
        $this->assertEquals($pascal, $instance->toPascalCase()->toString());
        $this->assertEquals($camel, $instance->toCamelCase()->toString());
    }
}
