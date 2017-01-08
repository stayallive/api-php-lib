<?php

// Copyright 1999-2016. Parallels IP Holdings GmbH.

namespace PleskX\Api\Operator;

use PleskX\Api\Struct\Site as Struct;

class Site extends \PleskX\Api\Operator
{
    /**
     * @param  array       $properties
     * @return Struct\Info
     */
    public function create(array $properties)
    {
        $packet = $this->_client->getPacket();
        $info   = $packet->addChild($this->_wrapperTag)->addChild('add');

        $infoGeneral = $info->addChild('gen_setup');
        foreach ($properties as $name => $value) {
            $infoGeneral->addChild($name, $value);
        }

        $response = $this->_client->request($packet);

        return new Struct\Info($response);
    }

    /**
     * @param  string     $field
     * @param  int|string $value
     * @return bool
     */
    public function delete($field, $value)
    {
        return $this->_delete($field, $value);
    }

    /**
     * @param  string             $field
     * @param  int|string         $value
     * @return Struct\GeneralInfo
     */
    public function get($field, $value)
    {
        return $this->_getItem([
            'gen_info' => Struct\GeneralInfo::class
        ], $field, $value)['gen_info'];
    }

    /**
     * @return Struct\GeneralInfo[]
     */
    public function getAll()
    {
        return array_map(function ($response) {
            return $response['gen_info'];
        }, $this->_getItems([
            'gen_info' => Struct\GeneralInfo::class
        ]));
    }
}
