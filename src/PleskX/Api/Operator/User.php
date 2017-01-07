<?php

// Copyright 1999-2016. Parallels IP Holdings GmbH.

namespace PleskX\Api\Operator;

use PleskX\Api\Struct\User as Struct;

class User extends \PleskX\Api\Operator
{
    /**
     * @param  string      $role
     * @param  array       $properties
     * @return Struct\Info
     */
    public function create($role, $properties)
    {
        $packet  = $this->_client->getPacket();
        $addNode = $packet->addChild($this->_wrapperTag)->addChild('add');
        $info    = $addNode->addChild('gen-info');

        foreach ($properties as $name => $value) {
            $info->addChild($name, $value);
        }

        $addNode->addChild('roles')->addChild('name', $role);

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
        $packet = $this->_client->getPacket();
        $getTag = $packet->addChild($this->_wrapperTag)->addChild('get');
        $getTag->addChild('filter')->addChild($field, $value);
        $getTag->addChild('dataset')->addChild('gen-info');
        $response = $this->_client->request($packet);

        return new Struct\GeneralInfo($response->data->{'gen-info'});
    }
}
