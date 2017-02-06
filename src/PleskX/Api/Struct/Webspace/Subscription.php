<?php

namespace PleskX\Api\Struct\Webspace;

use SimpleXMLElement;
use PleskX\Api\Struct;

class Subscription extends Struct
{
    /**
     * Is not updated on associated service plan updates.
     *
     * @var bool
     */
    public $locked;

    /**
     * Is synced with the service plan.
     *
     * @var bool
     */
    public $synchronized;

    /**
     * The additional plans attached to this subscription.
     *
     * @var string[]
     */
    public $plans = [];

    /**
     * Subscription constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'locked',
            'synchronized',
        ]);

        foreach ($apiResponse->plan as $plan) {
            $this->plans[] = (string)$plan->{'plan-guid'};
        }
    }
}
