<?php

namespace PleskX\Api\Struct\Webspace;

use SimpleXMLElement;
use PleskX\Api\Struct;

class Preferences extends Struct
{
    /**
     * Indicates the use of the www prefix with the site name.
     *
     * @var bool
     */
    public $wwwPrefix;

    /**
     * The number of months during which the subscription traffic statistics is kept.
     *
     * @var int
     */
    public $statsTtl;

    /**
     * The number of email messages per hour that can be sent from a domain.
     *
     * @var int
     */
    public $outgoingMessagesDomainLimit;

    /**
     * Preferences constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            ['www' => 'wwwPrefix'],
            ['stat_ttl' => 'statsTtl'],
            'outgoing-messages-domain-limit',
        ]);
    }
}
