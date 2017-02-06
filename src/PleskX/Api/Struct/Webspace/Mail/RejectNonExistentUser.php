<?php

namespace PleskX\Api\Struct\Webspace\Mail;

class RejectNonExistentUser extends NonExistentUser
{
    /**
     * The strategy type.
     *
     * @var string
     */
    public $type = 'reject';
}
