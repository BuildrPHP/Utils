<?php namespace BuildR\Utils\Exception;

use BuildR\Foundation\Exception\Exception;

class IntegrationException extends Exception {

    const MESSAGE_INVALID_METHOD = 'The integration module (%s) not contains method like this: %s';

    public static function nonExistingMethod($integrationException, $methodName) {
        return self::createByFormat(self::MESSAGE_INVALID_METHOD, [$integrationException, $methodName]);
    }

}
