<?php

namespace PleskX\Api\Struct\Webspace\HostingInfo;

use SimpleXMLElement;
use PleskX\Api\Struct;

class StandardForwarding extends Struct
{
    /**
     * The destination url.
     *
     * @var string
     */
    public $destinationUrl;

    /**
     * The IP addresses.
     *
     * @var string[]
     */
    public $ipAddresses = [];

    /**
     * PhysicalHosting constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->destinationUrl = (string)$apiResponse->dest_url;
        $this->ipAddresses    = (array)$apiResponse->ip_address;
    }
}
