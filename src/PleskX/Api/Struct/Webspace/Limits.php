<?php

namespace PleskX\Api\Struct\Webspace;

use SimpleXMLElement;
use PleskX\Api\Struct;

class Limits extends Struct
{
    /**
     * The overuse strategy.
     *
     * Possible values:
     * - block
     * - notify
     * - normal
     * - not_suspend
     * - not_suspend_notify
     *
     * @var string
     */
    public $overuse;

    /**
     * The limits.
     *
     * @var Struct\Property[]
     */
    public $limits = [];

    /**
     * Limits constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->overuse = (string)$apiResponse->overuse;

        foreach ($apiResponse->limit as $limit) {
            $this->limits[(string)$limit->name] = new Struct\Property($limit);
        }
    }
}
