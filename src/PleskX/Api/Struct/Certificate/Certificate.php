<?php

namespace PleskX\Api\Struct\Certificate;

use SimpleXMLElement;
use PleskX\Api\Struct;

class Certificate extends Struct
{
    /**
     * The certificate signing request.
     *
     * @var string
     */
    public $csr;

    /**
     * The private key.
     *
     * @var string
     */
    public $privateKey;

    /**
     * Info constructor.
     *
     * @param \SimpleXMLElement $apiResponse
     */
    public function __construct(SimpleXMLElement $apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'csr',
            ['pvt' => 'privateKey'],
        ]);
    }
}
