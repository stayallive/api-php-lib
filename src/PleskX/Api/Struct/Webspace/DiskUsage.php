<?php

namespace PleskX\Api\Struct\Webspace;

use SimpleXMLElement;
use PleskX\Api\Struct;

class DiskUsage extends Struct
{
    /**
     * The amount of disk space (in bytes) occupied by the /httpdocs directory.
     *
     * @var int
     */
    public $httpdocs;

    /**
     * The amount of disk space (in bytes) occupied by the /httpsdocs directory.
     *
     * @var int
     */
    public $httpsdocs;

    /**
     * The amount of disk space (in bytes) occupied by subdomains on this subscription.
     *
     * @var int
     */
    public $subdomains;

    /**
     * The amount of disk space (in bytes) allotted for web users on the subscription.
     *
     * @var int
     */
    public $webUsers;

    /**
     * The amount of disk space (in bytes) occupied by anonymous FTP.
     *
     * @var int
     */
    public $anonFtp;

    /**
     * The amount of disk space (in bytes) occupied by logs.
     *
     * @var int
     */
    public $logs;

    /**
     * (UNIX only) the amount of disk space (in bytes) occupied by databases created.
     *
     * @var int
     */
    public $databases;

    /**
     * (Windows only) the amount of disk space (in bytes) occupied by MySQL databases created.
     *
     * @var int
     */
    public $mysqlDatabases;

    /**
     * (Windows only) the amount of disk space (in bytes) occupied by MSSQL databases created.
     *
     * @var int
     */
    public $mssqlDatabases;

    /**
     * The amount of disk space (in bytes) allotted by mailboxes.
     *
     * @var int
     */
    public $mailboxes;

    /**
     * The amount of disk space (in bytes) occupied by Tomcat web applications deployed.
     *
     * @var int
     */
    public $webapps;

    /**
     * The amount of disk space (in bytes) occupied by mailing lists.
     *
     * @var int
     */
    public $mailLists;

    /**
     * The amount of disk space (in bytes) occupied by dumps.
     *
     * @var int
     */
    public $domainDumps;

    /**
     * (UNIX only) the amount of disk space (in bytes) occupied by configuration files.
     *
     * @var int
     */
    public $configs;

    /**
     * (UNIX only) the amount of disk space (in bytes) occupied by the /chroot directory.
     *
     * @var int
     */
    public $chroot;

    /**
     * Get the sum of all the properties.
     *
     * @return int
     */
    public function getTotal()
    {
        return array_reduce((array)$this, function ($remember, $value) {
            return $remember + $value;
        }, 0);
    }

    /**
     * Statistics constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'httpdocs',
            'httpsdocs',
            'subdomains',
            'web_users',
            ['anonftp' => 'anonFtp'],
            'logs',
            ['dbases' => 'databases'],
            ['mysql_dbases' => 'mysqlDatabases'],
            ['mssql_dbases' => 'mssqlDatabases'],
            'mailboxes',
            'webapps',
            ['maillists' => 'mailLists'],
            ['domaindumps' => 'domainDumps'],
            'configs',
            'chroot',
        ]);
    }
}
