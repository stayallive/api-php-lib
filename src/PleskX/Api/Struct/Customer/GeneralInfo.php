<?php

// Copyright 1999-2016. Parallels IP Holdings GmbH.

namespace PleskX\Api\Struct\Customer;

use PleskX\Api\Struct;

class GeneralInfo extends Struct
{
    /** @var string */
    public $creationDate;

    /** @var string */
    public $company;

    /** @var string */
    public $personalName;

    /** @var string */
    public $login;

    /** @var int */
    public $status;

    /** @var string */
    public $phone;

    /** @var string */
    public $fax;

    /** @var string */
    public $email;

    /** @var string */
    public $address;

    /** @var string */
    public $city;

    /** @var string */
    public $state;

    /** @var string */
    public $postalCode;

    /** @var string */
    public $country;

    /** @var string */
    public $locale;

    /** @var string */
    public $guid;

    /** @var string */
    public $ownerLogin;

    /** @var string */
    public $vendorGuid;

    /** @var string */
    public $externalId;

    /** @var string */
    public $description;

    /** @var string */
    public $password;

    /** @var string */
    public $passwordType;

    /**
     * GeneralInfo constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct($apiResponse)
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
            'owner-login',
            'vendor-guid',
            'external-id',
            'description',
            'password',
            'password_type',
        ]);
    }
}
