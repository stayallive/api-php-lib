<?php

namespace PleskX\Api\Struct\Customer;

use PleskX\Api\Struct;

class Customer extends Struct
{
    /**
     * The customer general info.
     *
     * @var GeneralInfo|null
     */
    public $info;

    /**
     * The customers statistics.
     *
     * @var Stats|null
     */
    public $stats;

    /**
     * Customer constructor.
     *
     * @param array $apiResponse
     */
    public function __construct($apiResponse)
    {
        $this->_initStructProperties($apiResponse, [
            ['gen_info' => 'info'],
            ['stat' => 'stats'],
        ]);
    }
}
