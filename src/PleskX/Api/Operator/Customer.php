<?php

declare(strict_types = 1);

namespace PleskX\Api\Operator;

use PleskX\Api\Operator;
use PleskX\Api\Struct\Customer as Struct;

class Customer extends Operator
{
    /**
     * Get the full customer information.
     *
     * @param string $field
     * @param mixed  $value
     *
     * @return \PleskX\Api\Struct\Customer\Customer
     */
    public function get(string $field, $value): Struct\Customer
    {
        return $this->_getItemCollection(Struct\Customer::class, [
            'gen_info' => Struct\GeneralInfo::class,
            'stat'     => Struct\Stats::class,
        ], $field, $value);
    }

    /**
     * Get the general info from the customer.
     *
     * @param string     $field
     * @param int|string $value
     *
     * @return Struct\GeneralInfo
     */
    public function getGeneralInfo(string $field, $value): Struct\GeneralInfo
    {
        return $this->_getItem([
            'gen_info' => Struct\GeneralInfo::class,
        ], $field, $value)['gen_info'];
    }

    /**
     * Get the customer statistics.
     *
     * @param string     $field
     * @param int|string $value
     *
     * @return Struct\Stats
     */
    public function getStats(string $field, $value): Struct\Stats
    {
        return $this->_getItem([
            'stat' => Struct\Stats::class,
        ], $field, $value)['stat'];
    }


    /**
     * Get all full customers.
     *
     * @return Struct\Customer[]
     */
    public function getAll(): array
    {
        return $this->_getItemCollections(Struct\Customer::class, [
            'gen_info' => Struct\GeneralInfo::class,
            'stat'     => Struct\Stats::class,
        ]);
    }

    /**
     * Get the general info from all customers.
     *
     * @return Struct\GeneralInfo[]
     */
    public function getAllGeneralInfo(): array
    {
        return array_map(function (Struct\Customer $customer) {
            return $customer->info;
        }, $this->_getItemCollections(Struct\Customer::class, [
            'gen_info' => Struct\GeneralInfo::class,
        ]));
    }

    /**
     * Get the statistics from all customers.
     *
     * @return Struct\Stats[]
     */
    public function getAllStats(): array
    {
        return array_map(function (Struct\Customer $customer) {
            return $customer->stats;
        }, $this->_getItemCollections(Struct\Customer::class, [
            'stat' => Struct\Stats::class,
        ]));
    }


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
     * Delete a customer.
     *
     * @param string     $field
     * @param int|string $value
     *
     * @return bool
     */
    public function delete(string $field, $value): bool
    {
        return $this->_delete($field, $value);
    }
}
