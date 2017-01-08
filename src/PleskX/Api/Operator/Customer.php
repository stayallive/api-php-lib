<?php

declare(strict_types = 1);

namespace PleskX\Api\Operator;

use PleskX\Api\CRUDOperator;
use PleskX\Api\Struct\Customer as Struct;

/**
 * Customer operator.
 *
 * @method Struct\Customer get(string $filter, $key, array $with)
 * @method Struct\Customer[] getAll(string $filter, $key, array $with)
 */
class Customer extends CRUDOperator
{
    const GENERAL_INFO = 'gen_info';
    const STATISTICS   = 'stat';

    /**
     * Create a customer.
     *
     * @param array $properties
     *
     * @return Struct\Info
     */
    public function create(array $properties): Struct\Info
    {
        $packet = $this->_client->getPacket();
        $info   = $packet->addChild($this->_wrapperTag)->addChild('add')->addChild('gen_info');

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
        return Struct\Customer::class;
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
            self::STATISTICS   => Struct\Stats::class,
        ];
    }
}
