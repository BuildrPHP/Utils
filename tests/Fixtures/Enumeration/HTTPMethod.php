<?php namespace BuildR\Utils\Tests\Fixtures\Enumeration;

use BuildR\Utils\Enumeration\AbstractEnumeration;

class HTTPMethod extends AbstractEnumeration {

    const METHOD_GET = 'GET';

    const METHOD_POST = 'POST';

    /* ... */

    private $methodDescriptions = [
        'GET' => 'Description for GET method',
    ];

    public function describe() {
        if(isset($this->methodDescriptions[$this->value])) {
            return $this->methodDescriptions[$this->value];
        }

        return NULL;
    }

}
