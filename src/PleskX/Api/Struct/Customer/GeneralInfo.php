<?php

namespace PleskX\Api\Struct\Customer;

use SimpleXMLElement;
use PleskX\Api\Struct;

class GeneralInfo extends Struct\User
{
    /**
     * The administrator user ID.
     *
     * @var int
     */
    public $ownerId;

    /**
     * The administrator username (only available when authenticating as admin).
     *
     * @var string
     */
    public $ownerLogin;

    /**
     * The service provider global unique user ID.
     *
     * @var string
     */
    public $vendorGuid;

    /**
     * GeneralInfo constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            ['cr_date' => 'creationDate'],
            ['cname' => 'company'],
            ['pname' => 'personalName'],
            'login',
            'status',
            'phone',
            'fax',
            'email',
            'address',
            'city',
            'state',
            ['pcode' => 'postalCode'],
            'country',
            'locale',
            'guid',
            'owner-id',
            'owner-login',
            'vendor-guid',
            'external-id',
            'description',
            'password',
            'password_type',
        ]);
    }
}
