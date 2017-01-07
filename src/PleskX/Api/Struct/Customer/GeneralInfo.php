<?php

namespace PleskX\Api\Struct\Customer;

use PleskX\Api\Struct;

class GeneralInfo extends Struct
{
    /**
     * The date when the account was created.
     *
     * @var string
     */
    public $creationDate;

    /**
     * The company name.
     *
     * @var string
     */
    public $company;

    /**
     * The personal name.
     *
     * @var string
     */
    public $personalName;

    /**
     * The login name (username).
     *
     * @var string
     */
    public $login;

    /**
     * The current status.
     *
     * Possible values:
     * - 0   (active)
     * - 4   (under backup/restore)
     * - 16  (disabled_by admin)
     * - 256 (expired)
     *
     * @var int
     */
    public $status;

    /**
     * The phone number.
     *
     * @var string
     */
    public $phone;

    /**
     * The fax number.
     *
     * @var string
     */
    public $fax;

    /**
     * The email address.
     *
     * @var string
     */
    public $email;

    /**
     * The postal address.
     *
     * @var string
     */
    public $address;

    /**
     * The city.
     *
     * @var string
     */
    public $city;

    /**
     * The state.
     *
     * @var string
     */
    public $state;

    /**
     * The postal code.
     *
     * @var string
     */
    public $postalCode;

    /**
     * The 2-character country code.
     *
     * @var string
     */
    public $country;

    /**
     * The locale.
     *
     * @var string
     */
    public $locale;

    /**
     * The global user ID.
     *
     * @var string
     */
    public $guid;

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
     * The customer GUID in the Panel components (for example, Business Manager).
     *
     * @var string
     */
    public $externalId;

    /**
     * The customer description (only available when authenticating as admin).
     *
     * @var string
     */
    public $description;

    /**
     * The password in the format of $passwordType.
     *
     * @var string
     */
    public $password;

    /**
     * The type of the customer account password.
     *
     * Possible values:
     * - crypt
     * - plain
     *
     * @var string
     */
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
