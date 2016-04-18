<?php namespace BuildR\Utils\Tests\Fixtures\Enumeration;

use BuildR\Utils\Enumeration\EnumerationBase;

class HTTPMethod extends EnumerationBase {

    const GET = 'GET';

    const POST = 'POST';

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
