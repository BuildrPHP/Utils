<?php namespace BuildR\Utils\Integration;

class BuiltInStringFunctionsIntegration implements IntegrationInterface {

    private $supportedMethods = [
        'toUpper' => ['method' => 'mb_strtoupper'],
        'toLower' => ['method' => 'mb_strtolower'],
        'replace' => ['method' => 'str_replace'],
    ];

    /**
     * {@inheritDoc}
     */
    public function hasMethod($name) {
        return array_key_exists($name, $this->supportedMethods);
    }

    /**
     * {{@inheritDoc}}
     */
    public function run($method, array $arguments = []) {
        $methodDetails = $this->supportedMethods[$method];

        return call_user_func_array($methodDetails['method'], $arguments);
    }

}
