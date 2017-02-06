<?php

namespace PleskX\Api\Struct\Webspace;

use SimpleXMLElement;
use PleskX\Api\Struct;

class Performance extends Struct
{
    /**
     * The network usage (Kb/sec) for the subscription.
     *
     * @var int
     */
    public $bandwidth;

    /**
     * The number of connections.
     *
     * @var int
     */
    public $maxConnections;

    /**
     * Performance constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'bandwidth',
            'max_connections',
        ]);
    }
}
