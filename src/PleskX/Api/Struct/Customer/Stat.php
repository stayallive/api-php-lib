<?php

namespace PleskX\Api\Struct\Customer;

use PleskX\Api\Struct;

class Stat extends Struct
{
    /**
     * The number of active webspaces.
     *
     * @var int
     */
    public $activeDomains;

    /**
     * The number of sub-domains.
     *
     * @var int
     */
    public $subdomains;

    /**
     * The amount of disk space occupied (in bytes).
     *
     * @var int
     */
    public $diskSpace;

    /**
     * The number of email boxes.
     *
     * @var int
     */
    public $mailboxes;

    /**
     * The number of redirects.
     *
     * @var int
     */
    public $redirects;

    /**
     * The number of email groups.
     *
     * @var int
     */
    public $mailGroups;

    /**
     * The number of automatic response messages.
     *
     * @var int
     */
    public $mailAutoResponses;

    /**
     * The number of mailing lists created.
     *
     * @var int
     */
    public $mailLists;

    /**
     * The number of web users.
     *
     * @var int
     */
    public $webUsers;

    /**
     * The number of databases.
     *
     * @var int
     */
    public $databases;

    /**
     * The number of Tomcat web applications.
     *
     * @var int
     */
    public $webapps;

    /**
     * The amount of traffic (in bytes) spent monthly.
     *
     * @var int
     */
    public $traffic;

    /**
     * The amount of traffic (in bytes) spent during the previous day.
     *
     * @var int
     */
    public $trafficYesterday;

    /**
     * Stat constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct($apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'active_domains',
            'subdomains',
            'disk_space',
            ['postboxs' => 'mailboxes'],
            'redirects',
            'mail_groups',
            ['mail_resps' => 'mailAutoResponses'],
            'mail_lists',
            'web_users',
            ['data_bases' => 'databases'],
            'webapps',
            'traffic',
            ['traffic_prevday' => 'trafficYesterday'],
        ]);
    }
}
