<?php

namespace PleskX\Api\Struct\Reseller;

use PleskX\Api\Struct;

class Reseller extends Struct
{
    /**
     * The reseller general info.
     *
     * @var GeneralInfo|null
     */
    public $info;

    /**
     * Reseller constructor.
     *
     * @param array $apiResponse
     */
    public function __construct(array $apiResponse)
    {
        $this->_initStructProperties($apiResponse, [
            ['gen-info' => 'info'],
        ]);
    }
}
