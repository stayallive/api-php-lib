<?php

// Copyright 1999-2016. Parallels IP Holdings GmbH.

namespace PleskX\Api;

class Operator
{
    /** @var string|null */
    protected $_wrapperTag = null;

    /** @var Client */
    protected $_client;

    public function __construct($client)
    {
        $this->_client = $client;

        if (is_null($this->_wrapperTag)) {
            $classNameParts    = explode('\\', get_class($this));
            $this->_wrapperTag = end($classNameParts);
            $this->_wrapperTag = strtolower(preg_replace('/([a-z])([A-Z])/', '\1-\2', $this->_wrapperTag));
        }
    }

    /**
     * Perform plain API request.
     *
     * @param  string|array $request
     * @param  int          $mode
     * @return XmlResponse
     */
    public function request($request, $mode = Client::RESPONSE_SHORT)
    {
        $wrapperTag = $this->_wrapperTag;

        if (is_array($request)) {
            $request = [$wrapperTag => $request];
        } elseif (preg_match('/^[a-z]/', $request)) {
            $request = "$wrapperTag.$request";
        } else {
            $request = "<$wrapperTag>$request</$wrapperTag>";
        }

        return $this->_client->request($request, $mode);
    }

    /**
     * @param  string     $field
     * @param  int|string $value
     * @param  string     $deleteMethodName
     * @return bool
     */
    protected function _delete($field, $value, $deleteMethodName = 'del')
    {
        $response = $this->request("$deleteMethodName.filter.$field=$value");

        return 'ok' === (string)$response->status;
    }

    /**
     * Get a single item from the API response.
     *
     * @param array           $datasets
     * @param string|null     $field
     * @param int|string|null $value
     *
     * @return mixed
     */
    protected function _getItem(array $datasets = [], $field = null, $value = null)
    {
        return $this->_getItems($datasets, $field, $value)[0];
    }

    /**
     * Get a single item collection from the API response.
     *
     * @param string          $collectionClass
     * @param array           $datasets
     * @param string|null     $field
     * @param int|string|null $value
     *
     * @return mixed
     */
    protected function _getItemCollection($collectionClass, array $datasets = [], $field = null, $value = null)
    {
        return new $collectionClass($this->_getItems($datasets, $field, $value)[0]);
    }

    /**
     * Get all items from the API response.
     *
     * @param array           $datasets
     * @param string|null     $field
     * @param int|string|null $value
     *
     * @return mixed
     */
    protected function _getItems(array $datasets = [], $field = null, $value = null)
    {
        $packet = $this->_client->getPacket();
        $getTag = $packet->addChild($this->_wrapperTag)->addChild('get');

        $filterTag = $getTag->addChild('filter');
        if (!is_null($field)) {
            $filterTag->addChild($field, $value);
        }

        $datasetsTag = $getTag->addChild('dataset');
        foreach ($datasets as $dataset => $struct) {
            $datasetsTag->addChild($dataset);
        }

        $response = $this->_client->request($packet, Client::RESPONSE_FULL);

        $items = [];
        foreach ($response->xpath('//result') as $xmlResult) {
            $data = [];

            foreach ($datasets as $dataset => $struct) {
                $data[$dataset] = new $struct($xmlResult->data->$dataset);
            }

            $items[] = $data;
        }

        return $items;
    }

    /**
     * Get a single item collection from the API response.
     *
     * @param string          $collectionClass
     * @param array           $datasets
     * @param string|null     $field
     * @param int|string|null $value
     *
     * @return mixed
     */
    protected function _getItemCollections($collectionClass, array $datasets = [], $field = null, $value = null)
    {
        return array_map(function ($response) use ($collectionClass) {
            return new $collectionClass($response);
        }, $this->_getItems($datasets, $field, $value));
    }
}
