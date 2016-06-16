<?php namespace BuildR\Utils\Tests\Fixtures\Enumeration;

use BuildR\Utils\Enumeration\EnumerationBase;
use BuildR\Utils\Enumeration\EnumerationFieldDefinitionInterface;

/**
 * Test fixture to test enumerations with multiple fields
 * This example is the direct port of Java 'Enum Types' tutorial
 *
 * @see https://docs.oracle.com/javase/tutorial/java/javaOO/enum.html
 */
class Planet extends EnumerationBase implements EnumerationFieldDefinitionInterface {

    const MERCURY = "MERCURY";
    const VENUS = "VENUS";
    const EARTH = "EARTH";
    const MARS = "MARS";
    const JUPITER = "JUPITER";
    const SATURN = "SATURN";
    const URANUS = "URANUS";
    const NEPTUNE = "NEPTUNE";

    /**
     * @type double
     */
    public $mass;

    /**
     * @type double
     */
    public $radius;


    /**
     * {@inheritdoc}
     */
    public static function defineFields() {
        return [
            self::MERCURY => [3.303e+23, 2.4397e6],
            self::VENUS => [4.869e+24, 6.0518e6],
            self::EARTH => [5.976e+24, 6.37814e6],
            self::MARS => [6.421e+23, 3.3972e6],
            self::JUPITER => [1.9e+27,   7.1492e7],
            self::SATURN => [5.688e+26, 6.0268e7],
            self::URANUS => [8.686e+25, 2.5559e7],
            self::NEPTUNE => [1.024e+26, 2.4746e7],
        ];
    }

    public function __construct($value, $mass, $radius) {
        $this->mass = $mass;
        $this->radius = $radius;

        parent::__construct($value);
    }

    public function surfaceGravity() {
        return 6.67300E-11 * $this->mass / ($this->radius * $this->radius);
    }

    public function surfaceWeight($otherMass) {
        return (double) $otherMass * $this->surfaceGravity();
    }

}
