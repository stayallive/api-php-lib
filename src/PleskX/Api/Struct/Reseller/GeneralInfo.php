<?php

namespace PleskX\Api\Struct\Reseller;

use SimpleXMLElement;
use PleskX\Api\Struct;

class GeneralInfo extends Struct\User
{
    /**
     * Indicates if the user is a power user.
     *
     * @var bool
     */
    public $powerUser;

    /**
     * GeneralInfo constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            ['cr-date' => 'creationDate'],
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
            'external-id',
            'description',
            'password',
            'password-type',
        ]);
    }
}
