<?php namespace BuildR\Utils\Tests\Unit\Factories;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\TestTools\DataSetLoader\DataSetLoaderFactory;
use BuildR\Utils\Factories\StringFactory;
use BuildR\Utils\Tests\Fixtures\RawStringConvertibleObject;
use BuildR\Utils\Tests\Fixtures\StringConvertibleObject;

class StringFactoryTest extends BuildR_TestCase {

    public function validDataSetProvider() {
        $loader = DataSetLoaderFactory::XML(TESTS_DATA_SET_LOCATION . DS . 'StringFactory.xml', 'validDataGroup');
        return $loader->getResult();
    }
    
    /**
     * @expectedException \BuildR\Foundation\Exception\InvalidArgumentException
     * @expectedExceptionMessage Arrays cannot be casted to string!
     */
    public function testItThrowsExceptionWhenTheInputIsArray() {
        $input = ['test' => 'this not work'];
        StringFactory::create($input);
    }

    /**
     * @expectedException  \BuildR\Foundation\Exception\InvalidArgumentException
     * @expectedExceptionMessage The given value is an object but cant converted to string!
     */
    public function testItThrowsExceptionWhenGiveAnObjectThatCannotBeConvertedToString() {
        $input = new \stdClass();
        StringFactory::create($input);
    }

    public function testSubclassesOfStringConvertibleInterfaceIsConvertedSuccessfully() {
        $input = new StringConvertibleObject();
        $instance = StringFactory::create($input);

        $this->assertEquals(StringConvertibleObject::returnValue, $instance->toString());
    }

    public function testItConvertsPlainObjectWhichHasPhpToStringMagicMethod() {
        $input = new RawStringConvertibleObject();
        $instance = StringFactory::create($input);

        $this->assertEquals(RawStringConvertibleObject::returnValue, $instance->toString());
    }

    /**
     * @dataProvider validDataSetProvider
     */
    public function testItWorksWithAllValidInput($input, $expected) {
        $instance = StringFactory::create($input);

        $this->assertEquals($expected, $instance->toString());
    }

}
