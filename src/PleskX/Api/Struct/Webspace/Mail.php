<?php

namespace PleskX\Api\Struct\Webspace;

use SimpleXMLElement;
use PleskX\Api\Struct;

class Mail extends Struct
{
    /**
     * How non existent users are handled.
     *
     * @var Mail\NonExistentUser
     */
    public $nonExistentUser;

    /**
     * Webmail enabled.
     *
     * @var bool
     */
    public $webmail;

    /**
     * DomainKeys protection enabled.
     *
     * @var bool
     */
    public $domainKeys;

    /**
     * Greylisting enabled.
     *
     * @var bool
     */
    public $greylisting;

    /**
     * Mail servie enabled.
     *
     * @var bool
     */
    public $mailService;

    /**
     * The certificate used for webmail.
     *
     * @var string
     */
    public $webmailCertificate;

    /**
     * The IP's used for the mail service.
     *
     * @var array
     */
    public $ipAddresses;

    /**
     * The limit on outgoing messages per mailbox.
     *
     * @var string|int
     */
    public $outgoingLimitMailbox;

    /**
     * The limit on outgoing messages for the domain.
     *
     * @var string|int
     */
    public $outgoingLimitDomain;

    /**
     * The limit on outgoing messages for the subscription.
     *
     * @var string|int
     */
    public $outgoingLimitSubscription;

    /**
     * If sendmail is allowed for outgoing messages.
     *
     * @var string|bool
     */
    public $outgoingEnableSendmail;

    /**
     * Mail constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $strategy   = array_keys((array)$apiResponse->{"nonexistent-user"})[0];
        $strategies = [
            'reject'  => Mail\RejectNonExistentUser::class,
            'bounce'  => Mail\BounceNonExistentUser::class,
            'forward' => Mail\ForwardNonExistentUser::class,
        ];

        $this->nonExistentUser = new $strategies[$strategy](
            (string)$apiResponse->{"nonexistent-user"}[$strategy]
        );

        $this->_initScalarProperties($apiResponse, [
            'webmail',
            ['spam-protect-sign' => 'domainKeys'],
            'greylisting',
            ['mailservice' => 'mailService'],
            'webmail-certificate',
            ['outgoing-messages-mbox-limit' => 'outgoingLimitMailbox'],
            ['outgoing-messages-domain-limit' => 'outgoingLimitDomain'],
            ['outgoing-messages-subscription-limit' => 'outgoingLimitSubscription'],
            ['outgoing-messages-enable-sendmail' => 'outgoingEnableSendmail'],
        ]);

        $this->ipAddresses = (array)$apiResponse->ip_address;
    }
}
