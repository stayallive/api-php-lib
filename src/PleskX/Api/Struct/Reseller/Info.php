<?php

namespace PleskX\Api\Struct\Reseller;

use SimpleXMLElement;
use PleskX\Api\Struct;

class Info extends Struct
{
    /**
     * The reseller user ID.
     *
     * @var int
     */
    public $id;

    /**
     * The reseller globally unique user ID.
     *
     * @var string
     */
    public $guid;

    /**
     * Info constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'id',
            'guid',
        ]);
    }
}
