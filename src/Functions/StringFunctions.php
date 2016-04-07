<?php namespace BuildR\Utils\Functions;

use BuildR\Utils\Factories\StringFactory;

/**
 * Creates a new StringObject function from the given string,
 * using the pre-defined factory that validates the input.
 *
 * @param string $inputString
 *
 * @return \BuildR\Utils\StringObject
 * @throws \BuildR\Foundation\Exception\InvalidArgumentException
 */
function str($inputString) {
    return StringFactory::create($inputString);
}
