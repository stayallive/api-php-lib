<?php

namespace PleskX\Api\Operator;

use PleskX\Api\Operator;
use PleskX\Api\Struct\Certificate as Struct;

class Certificate extends Operator
{
    /**
     * Generate a certificate signing request and a private key for an SSL/TLS certificate.
     *
     * @param array $properties
     *
     * @return Struct\Certificate
     */
    public function generate(array $properties): Struct\Certificate
    {
        $packet  = $this->_client->getPacket();
        $request = $packet->addChild($this->_wrapperTag)->addChild('generate')->addChild('info');

        foreach ($properties as $name => $value) {
            $request->addChild($name, $value);
        }

        $response = $this->_client->request($packet);

        return new Struct\Certificate($response);
    }

    public function list(string $filter, $value)
    {
        $packet = $this->_client->getPacket();
        $pool   = $packet->addChild($this->_wrapperTag)->addChild('get-pool');

        if ($filter === 'admin') {
            $pool->addChild('admin');
        } else {
            $pool->addChild('filter')
                 ->addChild($filter, $value);
        }

        return $this->_client->request($packet);
    }
}
