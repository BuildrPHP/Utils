<?php namespace BuildR\Utils\Integration;

interface IntegrationInterface {

    /**
     * Determines that the current integration support the given method name
     *
     * @param string $name The method name
     *
     * @return bool
     */
    public function hasMethod($name);

    /**
     * @param string $method The method name
     * @param array $arguments Optional method arguments
     *
     * @return mixed
     */
    public function run($method, array $arguments = []);

}
