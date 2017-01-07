<?php

namespace PleskX\Api\Struct\Customer;

use PleskX\Api\Struct;

class Info extends Struct
{
    /**
     * The unique identifier.
     *
     * @var int
     */
    public $id;

    /**
     * The global user ID.
     *
     * @var string
     */
    public $guid;

    /**
     * Info constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct($apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'id',
            'guid',
        ]);
    }
}
