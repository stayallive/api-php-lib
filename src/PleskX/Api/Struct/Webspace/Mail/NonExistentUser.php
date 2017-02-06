<?php

namespace PleskX\Api\Struct\Webspace\Mail;

use PleskX\Api\Struct;

abstract class NonExistentUser extends Struct
{
    /**
     * The address to bounce or forward to.
     *
     * @var string|null
     */
    public $address = null;

    /**
     * NonExistentUser constructor.
     *
     * @param string $apiResponse
     */
    public function __construct($apiResponse)
    {
        $this->address = (empty($apiResponse)) ? null : $apiResponse;
    }
}
