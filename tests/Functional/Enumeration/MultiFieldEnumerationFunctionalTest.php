<?php namespace BuildR\Utils\Tests\Functional\Extension;


use BuildR\TestTools\BuildR_TestCase;
use BuildR\Utils\Tests\Fixtures\Enumeration\Planet;

class MultiFieldEnumerationFunctionalTest extends BuildR_TestCase {

    private $expectedResults = [
        Planet::MERCURY => 66.107,
        Planet::VENUS => 158.374,
        Planet::EARTH => 175.000,
        Planet::MARS => 66.279,
        Planet::JUPITER => 442.847,
        Planet::SATURN => 186.552,
        Planet::URANUS => 158.397,
        Planet::NEPTUNE => 199.207,
    ];

    public function testItCalculatesWeightOnPlanetsCorrectly() {
        $constants = Planet::getKeys();
        $mass = 175 / Planet::EARTH()->surfaceGravity();

        foreach($constants as $planetName) {
            $planet = call_user_func_array(Planet::class . '::' . $planetName, [$planetName]);
            $weight = $planet->surfaceWeight($mass);

            $this->assertEquals($this->expectedResults[$planetName], $weight, '', 0.001);
        }
    }
    
}
