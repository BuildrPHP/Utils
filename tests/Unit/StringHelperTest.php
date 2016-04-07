<?php namespace BuildR\Utils\Tests\Unit\Factories;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\TestTools\DataSetLoader\DataSetLoaderFactory;
use BuildR\Utils\StringUtils;

class StringHelperTest extends BuildR_TestCase {

    const TEST_FILE = TESTS_DATA_SET_LOCATION . DS . 'StringHelper.xml';

    public function providerStartsWith() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'startsWithGroup')->getResult();
    }

    public function providerEndsWith() {
        return DataSetLoaderFactory::XML(self::TEST_FILE, 'endsWithGroup')->getResult();
    }

    /**
     * @dataProvider providerStartsWith
     */
    public function testStartsWithFunctionWorksCorrectly($input, $match, $expected) {
        $actual = StringUtils::startsWith($input, $match);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider providerEndsWith
     */
    public function testEndsWithFunctionWorksCorrectly($input, $match, $expected) {
        $actual = StringUtils::endsWith($input, $match);

        $this->assertEquals($expected, $actual);
    }

}
