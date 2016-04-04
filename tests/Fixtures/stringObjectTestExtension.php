<?php namespace BuildR\Utils\Tests\Fixtures;

use BuildR\Utils\Extension\AbstractObjectExtension;

class stringObjectTestExtension extends AbstractObjectExtension {

    /**
     * {@inheritDoc}
     */
    public function defineMethods() {
        return [
            'testify' => ['returnsRaw' => FALSE],
        ];
    }

    public function testify($input) {
        return '[TEST] ' . $input . ' [TEST]';
    }

}
