<?php

namespace PleskX\Api\Struct\Webspace\HostingInfo;

use SimpleXMLElement;
use PleskX\Api\Struct;

class PhysicalHosting extends Struct
{
    /**
     * The physical hosting properties.
     *
     * @var Struct\Property[]
     */
    public $properties = [];

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
        foreach ($apiResponse->property as $property) {
            $this->properties[(string)$property->name] = new Struct\Property($property);
        }

        $this->ipAddresses = (array)$apiResponse->ip_address;
    }
}
