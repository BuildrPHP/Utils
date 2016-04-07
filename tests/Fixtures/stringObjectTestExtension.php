<?php namespace BuildR\Utils\Tests\Fixtures;

use BuildR\Utils\Extension\AbstractObjectExtension;
use BuildR\Utils\Extension\StringObjectExtensionInterface;

class stringObjectTestExtension extends AbstractObjectExtension implements StringObjectExtensionInterface {

    /**
     * {@inheritDoc}
     */
    public function defineMethods() {
        return [
            'testify' => ['returnsRaw' => FALSE],
            'countAdditionalInput' => ['returnsRaw' => TRUE],
        ];
    }

    public function testify($input) {
        return '[TEST] ' . $input . ' [TEST]';
    }

    public function countAdditionalInput($input, $addition) {
        return mb_strlen($input) + $addition;
    }

}
