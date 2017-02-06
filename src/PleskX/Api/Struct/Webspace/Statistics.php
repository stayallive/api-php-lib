<?php

namespace PleskX\Api\Struct\Webspace;

use SimpleXMLElement;
use PleskX\Api\Struct;

class Statistics extends Struct
{
    /**
     * The subscription traffic (in bytes) spent during the current month.
     *
     * @var int
     */
    public $traffic;

    /**
     * The number of subdomains.
     *
     * @var int
     */
    public $subDomains;

    /**
     * The number of web users.
     *
     * @var int
     */
    public $webUsers;

    /**
     * The number of mail boxes.
     *
     * @var int
     */
    public $emailBoxes;

    /**
     * The number of redirects.
     *
     * @var int
     */
    public $redirects;

    /**
     * The number of mailing groups.
     *
     * @var int
     */
    public $mailingGroups;

    /**
     * The number of auto responders.
     *
     * @var int
     */
    public $autoResponders;

    /**
     * The number of mail lists.
     *
     * @var int
     */
    public $mailLists;

    /**
     * The number of databases.
     *
     * @var int
     */
    public $databases;

    /**
     * The number of JAVA web apps.
     *
     * @var int
     */
    public $webApps;

    /**
     * The subscription traffic (in bytes) spent yesterday.
     *
     * @var int
     */
    public $trafficYesterday;

    /**
     * Statistics constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'traffic',
            ['subdom'          => 'subDomains'],
            ['wu'              => 'webUsers'],
            ['box'             => 'emailBoxes'],
            ['redir'           => 'redirects'],
            ['mg'              => 'mailingGroups'],
            ['resp'            => 'autoResponders'],
            ['maillists'       => 'mailLists'],
            ['db'              => 'databases'],
            ['webapps'         => 'webApps'],
            ['traffic_prevday' => 'trafficYesterday'],
        ]);
    }
}
