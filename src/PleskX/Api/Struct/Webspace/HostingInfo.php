<?php

namespace PleskX\Api\Struct\Webspace;

use SimpleXMLElement;
use PleskX\Api\Struct;

class HostingInfo extends Struct
{
    /**
     * Physical hosting info.
     *
     * @var HostingInfo\PhysicalHosting|null
     */
    public $physicalHosting;

    /**
     * Standard forwarding info.
     *
     * @var HostingInfo\StandardForwarding|null
     */
    public $standardForwarding;

    /**
     * Frame forwarding info.
     *
     * @var HostingInfo\FrameForwarding|null
     */
    public $frameForwarding;

    /**
     * HostingInfo constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        if (isset($apiResponse->vrt_hst)) {
            $this->physicalHosting = new HostingInfo\PhysicalHosting($apiResponse->vrt_hst);
        }

        if (isset($apiResponse->std_fwd)) {
            $this->standardForwarding = new HostingInfo\StandardForwarding($apiResponse->std_fwd);
        }

        if (isset($apiResponse->frm_fwd)) {
            $this->frameForwarding = new HostingInfo\FrameForwarding($apiResponse->frm_fwd);
        }
    }
}
