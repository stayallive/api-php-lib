<?php

// Copyright 1999-2016. Parallels IP Holdings GmbH.

namespace PleskX\Api;

abstract class CRUDOperator extends Operator
{
    /**
     * Get a single item.
     *
     * @param string $field
     * @param mixed  $value
     * @param array  $with
     *
     * @throws \Exception
     * @return \PleskX\Api\Struct
     */
    public function get(string $field, $value, array $with = [])
    {
        if (empty($field) || empty($value)) {
            throw new \Exception('When retrieving an single item a filter must be defined.');
        }

        return $this->getItemCollection($this->getCollectionClass(), $this->getDatasets(), $with, $field, $value);
    }

    /**
     * Get all items.
     *
     * @param array  $with
     * @param string $field
     * @param mixed  $value
     *
     * @return \PleskX\Api\Struct[]
     */
    public function getAll(array $with = [], string $field, $value)
    {
        return $this->getItemCollections($this->getCollectionClass(), $this->getDatasets(), $with, $field, $value);
    }

    /**
     * Delete a item.
     *
     * @param string     $field
     * @param int|string $value
     *
     * @throws \Exception
     * @return bool
     */
    public function delete(string $field, $value): bool
    {
        if (empty($field) || empty($value)) {
            throw new \Exception('When deleting an item a filter must be defined.');
        }

        return $this->_delete($field, $value);
    }


    /**
     * Get the collection class for this Operator.
     *
     * @return string
     */
    abstract protected function getCollectionClass();

    /**
     * Get the available datasets for this Operator.
     *
     * @return array
     */
    abstract protected function getDatasets();


    /**
     * Get an item collection from the API.
     *
     * @param string $collectionStructClass
     * @param array  $datasets
     * @param array  $filter
     * @param string $field
     * @param mixed  $value
     *
     * @throws \Exception
     * @return mixed
     */
    protected function getItemCollection(
        $collectionStructClass,
        array $datasets = [],
        array $filter = [],
        string $field = null,
        $value = null
    ) {
        // Filter the datasets
        $datasets = array_filter($datasets, function ($key) use ($filter) {
            return in_array($key, $filter);
        }, ARRAY_FILTER_USE_KEY);

        // Make sure we are still retrieving something
        if (empty($datasets)) {
            throw new \Exception('You must specify at least one dataset to be returned.');
        }

        // Retrieve the data in the collection struct
        return $this->_getItemCollection($collectionStructClass, $datasets, $field, $value);
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
    private function _getItemCollection($collectionClass, array $datasets = [], $field = null, $value = null)
    {
        return new $collectionClass($this->_getItems($datasets, $field, $value)[0]);
    }

    /**
     * Get multiple items collection from the API.
     *
     * @param string $collectionStructClass
     * @param array  $datasets
     * @param array  $filter
     * @param string $field
     * @param mixed  $value
     *
     * @throws \Exception
     * @return mixed
     */
    protected function getItemCollections(
        $collectionStructClass,
        array $datasets = [],
        array $filter = [],
        string $field = null,
        $value = null
    ) {
        // Filter the datasets
        $datasets = array_filter($datasets, function ($key) use ($filter) {
            return in_array($key, $filter);
        }, ARRAY_FILTER_USE_KEY);

        // Make sure we are still retrieving something
        if (empty($datasets)) {
            throw new \Exception('You must specify at least one dataset to be returned.');
        }

        // Retrieve the data in the collection struct
        return $this->_getItemCollections($collectionStructClass, $datasets, $field, $value);
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
    private function _getItemCollections($collectionClass, array $datasets = [], $field = null, $value = null)
    {
        return array_map(function ($response) use ($collectionClass) {
            return new $collectionClass($response);
        }, $this->_getItems($datasets, $field, $value));
    }

    /**
     * @param string     $field
     * @param int|string $value
     * @param string     $deleteMethodName
     *
     * @return bool
     */
    protected function _delete($field, $value, $deleteMethodName = 'del')
    {
        $response = $this->request("$deleteMethodName.filter.$field=$value");

        return 'ok' === (string)$response->status;
    }
}
