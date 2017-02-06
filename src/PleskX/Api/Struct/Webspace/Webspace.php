<?php

namespace PleskX\Api\Struct\Webspace;

use PleskX\Api\Struct;

class Webspace extends Struct
{
    /**
     * The webspace general info.
     *
     * @var GeneralInfo|null
     */
    public $info;

    /**
     * The webspace hosting info.
     *
     * @var HostingInfo|null
     */
    public $hostingInfo;

    /**
     * The webspace limits.
     *
     * @var Limits|null
     */
    public $limits;

    /**
     * The webspace statistics.
     *
     * @var Statistics|null
     */
    public $statistics;

    /**
     * The webspace preferences.
     *
     * @var Preferences|null
     */
    public $preferences;

    /**
     * The webspace disk usage.
     *
     * @var DiskUsage|null
     */
    public $diskUsage;

    /**
     * The webspace disk usage.
     *
     * @var Performance|null
     */
    public $performance;

    /**
     * The webspace disk usage.
     *
     * @var Subscription|null
     */
    public $subscriptions;

    /**
     * The webspace disk usage.
     *
     * @var Mail|null
     */
    public $mail;

    /**
     * Webspace constructor.
     *
     * @param array $apiResponse
     */
    public function __construct(array $apiResponse)
    {
        $this->_initStructProperties($apiResponse, [
            ['gen_info' => 'info'],
            ['hosting' => 'hostingInfo'],
            'limits',
            ['stat'  => 'statistics'],
            ['prefs' => 'preferences'],
            'disk_usage',
            'performance',
            'subscriptions',
            'mail',
        ]);
    }
}
