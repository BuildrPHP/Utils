<?php namespace BuildR\Utils\Tests\Functional\Extension;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\Utils\Extension\ObjectExtensionInterface;
use BuildR\Utils\Factories\StringFactory;
use BuildR\Utils\Tests\Fixtures\stringObjectTestExtension;
use BuildR\Utils\Tests\Fixtures\stringObjectWrongExtension;
use BuildR\Utils\StringObject;

class StringObjectExtensionTest extends BuildR_TestCase {

    public function testReceiveTypeShouldReturnsAnObjectExtensionInterface() {
        $instance = StringFactory::create('testString');
        $implements = class_implements($instance->shouldReceiveType());

        $this->assertTrue(in_array(ObjectExtensionInterface::class, $implements));
    }

    /**
     * @expectedException \BuildR\Foundation\Exception\InvalidArgumentException
     * @expectedExceptionMessage This object only take BuildR\Utils\Extension\StringObjectExtensionInterface extensions! Given: BuildR\Utils\Tests\Fixtures\stringObjectWrongExtension
     */
    public function testItThrowsExceptionWhenReceiveNonValidExtension() {
        $instance = StringFactory::create('testString');
        $wrongExtension = new stringObjectWrongExtension();

        $instance->loadExtension($wrongExtension);
    }

    public function testItStoreExtensionsCorrectly() {
        $instance = StringFactory::create('testString');
        $extension = new stringObjectTestExtension();
        $instance->loadExtension($extension);

        //isLoaded
        $this->assertTrue($instance->isExtensionLoaded($extension));

        //isRegistered
        $extensions = $this->getPropertyValue(StringObject::class, 'extensions', $instance);
        $this->assertEquals($instance->getAllLoadedExtension(), array_keys($extensions));
        $this->assertArrayHasKey(stringObjectTestExtension::class, $extensions);
        $this->assertCount(1, $extensions);

        //storeOnClone
        $newInstance = $instance->prepend('Test');
        $this->assertNotSame($instance, $newInstance);
        $extensions = $this->getPropertyValue(StringObject::class, 'extensions', $newInstance);
        $this->assertEquals($newInstance->getAllLoadedExtension(), array_keys($extensions));
        $this->assertArrayHasKey(stringObjectTestExtension::class, $extensions);
        $this->assertCount(1, $extensions);
    }

    public function testMethodsOnExtensionsCallsCorrectly() {
        $instance = StringFactory::create('testString');
        $extension = new stringObjectTestExtension();
        $instance->loadExtension($extension);

        $result = $instance->testify();
        $this->assertInstanceOf(StringObject::class, $result);
        $this->assertEquals('[TEST] testString [TEST]', $result->toString());
    }

    public function testExecutesMethodsWithMultipleParameterAndRawReturnType() {
        $instance = StringFactory::create('testString');
        $extension = new stringObjectTestExtension();
        $instance->loadExtension($extension);

        $result = $instance->countAdditionalInput(5);
        $this->assertEquals(15, $result);
    }

}
