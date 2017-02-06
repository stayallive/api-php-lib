<?php

namespace PleskX\Api\Operator;

use PleskX\Api\CRUDOperator;
use PleskX\Api\Struct\Reseller as Struct;

class Reseller extends CRUDOperator
{
    const GENERAL_INFO = 'gen-info';

    /**
     * Create a new reseller.
     *
     * @param array $properties
     *
     * @return Struct\Info
     */
    public function create($properties)
    {
        $packet = $this->_client->getPacket();
        $info   = $packet->addChild($this->_wrapperTag)->addChild('add')->addChild('gen-info');

        foreach ($properties as $name => $value) {
            $info->addChild($name, $value);
        }

        $response = $this->_client->request($packet);

        return new Struct\Info($response);
    }

    /**
     * Get the collection class for this Operator.
     *
     * @return string
     */
    protected function getCollectionClass()
    {
        return Struct\Reseller::class;
    }

    /**
     * Get the available datasets for this Operator.
     *
     * @return array
     */
    protected function getDatasets()
    {
        return [
            self::GENERAL_INFO => Struct\GeneralInfo::class,
        ];
    }
}
