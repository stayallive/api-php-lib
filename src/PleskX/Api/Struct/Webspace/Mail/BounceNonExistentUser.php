<?php

namespace PleskX\Api\Struct\Webspace\Mail;

class BounceNonExistentUser extends NonExistentUser
{
    /**
     * The strategy type.
     *
     * @var string
     */
    public $type = 'bounce';
}
