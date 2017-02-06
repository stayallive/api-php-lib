<?php

namespace PleskX\Api\Struct\Webspace;

use SimpleXMLElement;
use PleskX\Api\Struct;

class GeneralInfo extends Struct
{
    /**
     * The creation date of the specified subscription.
     *
     * @var string
     */
    public $creationDate;

    /**
     * The subscription name displayed in Plesk.
     * For hosting subscriptions, this node holds a site name.
     *
     * @var string
     */
    public $name;

    /**
     * The subscription name in ASCII format.
     *
     * @var string
     */
    public $asciiName;

    /**
     * The current status.
     *
     * Possible values:
     * - 0   (active)
     * - 4   (under backup/restore)
     * - 16  (disabled by admin)
     * - 32  (disabled by reseller)
     * - 64  (disabled by customer)
     * - 256 (expired)
     *
     * @var int
     */
    public $status;

    /**
     * The actual size of the subscription (in bytes).
     *
     * @var int
     */
    public $realSize;

    /**
     * The ID of a Plesk user who owns this subscription.
     *
     * @var int
     */
    public $ownerId;

    /**
     * The username of Plesk user who owns this subscription.
     *
     * @var string
     */
    public $ownerLogin;

    /**
     * The IP address shown in DNS records.
     *
     * @var string
     */
    public $dnsIPAddress;

    /**
     * The type of hosting set on the subscription.
     *
     * Possible values:
     * - vrt_hst (physical hosting)
     * - std_fwd (standard forwarding)
     * - frm_fwd (frame forwarding)
     * - none    (none)
     *
     * @var string
     */
    public $hostingType;

    /**
     * The subscription GUID.
     *
     * @var string
     */
    public $guid;

    /**
     * The GUID of the customer's provider.
     *
     * @var string
     */
    public $vendorGuid;

    /**
     * The GUID of a subscription owner received from the Plesk components.
     *
     * @var string
     */
    public $externalId;

    /**
     * The UUID of a site created in Presence Builder for this subscription.
     *
     * @var string
     */
    public $sbSiteUuid;

    /**
     * The webspace description.
     *
     * @var string
     */
    public $description;

    /**
     * The webspace description for admin users.
     *
     * @var string
     */
    public $adminDescription;

    /**
     * GeneralInfo constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            ['cr_date' => 'creationDate'],
            'name',
            'ascii-name',
            'status',
            'real_size',
            'owner-id',
            'owner-login',
            ['dns_ip_address' => 'dnsIPAddress'],
            ['htype' => 'hostingType'],
            'guid',
            'vendor-guid',
            'external-id',
            'sb-site-uuid',
            'description',
            'admin-description',
        ]);
    }
}
