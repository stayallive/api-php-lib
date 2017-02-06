<?php

namespace PleskX\Api\Struct\Webspace\Mail;

class ForwardNonExistentUser extends NonExistentUser
{
    /**
     * The strategy type.
     *
     * @var string
     */
    public $type = 'forward';
}
