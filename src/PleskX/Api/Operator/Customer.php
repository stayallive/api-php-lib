<?php declare(strict_types = 1);

namespace PleskX\Api\Operator;

use PleskX\Api\Operator;
use PleskX\Api\Struct\Customer as Struct;

class Customer extends Operator
{
    /**
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
     * @param string     $field
     * @param int|string $value
     *
     * @return bool
     */
    public function delete(string $field, $value): bool
    {
        return $this->_delete($field, $value);
    }

    /**
     * @param string     $field
     * @param int|string $value
     *
     * @return Struct\GeneralInfo
     */
    public function get(string $field, $value): Struct\GeneralInfo
    {
        $items = $this->_getItems(Struct\GeneralInfo::class, 'gen_info', $field, $value);

        return reset($items);
    }

    /**
     * @param string     $field
     * @param int|string $value
     *
     * @return Struct\Stats
     */
    public function getStats(string $field, $value): Struct\Stats
    {
        $items = $this->_getItems(Struct\Stats::class, 'stat', $field, $value);

        return reset($items);
    }

    /**
     * @return Struct\GeneralInfo[]
     */
    public function getAll(): array
    {
        return $this->_getItems(Struct\GeneralInfo::class, 'gen_info');
    }
}
