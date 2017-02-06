<?php

namespace PleskX\Api\Struct;

use SimpleXMLElement;
use PleskX\Api\Struct;

class Property extends Struct
{
    /**
     * Property name.
     *
     * @var string
     */
    public $name;

    /**
     * Property value.
     *
     * @var string
     */
    public $value;

    /**
     * Property constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'name',
            'value',
        ]);
    }
}
