<?php

namespace PleskX\Api;

use ReflectionProperty;

abstract class Struct
{
    /**
     * Universal setter.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @throws \Exception
     */
    public function __set($property, $value)
    {
        throw new \Exception("Try to set an undeclared property '{$property}'.");
    }

    /**
     * Initialize list of scalar properties by response.
     *
     * @param \SimpleXMLElement $apiResponse
     * @param array             $properties
     *
     * @throws \Exception
     */
    protected function _initScalarProperties($apiResponse, array $properties)
    {
        foreach ($properties as $property) {
            if (is_array($property)) {
                $classProperty = current($property);
                $value         = $apiResponse->{key($property)};
            } else {
                $classProperty = $this->_underToCamel(str_replace('-', '_', $property));
                $value         = $apiResponse->$property;
            }

            // Get the doc comment from the property
            $reflectionProperty = new ReflectionProperty($this, $classProperty);
            $docBlock           = $reflectionProperty->getDocComment();

            // Extract the @var line in the docblock
            preg_match('/.*@var ([a-z]+).*/', $docBlock, $matches);

            // Get the matched property type
            list(, $propertyType) = $matches;

            if ($propertyType == 'string') {
                $value = (string)$value;
            } elseif ($propertyType == 'integer' || $propertyType == 'int') {
                $value = (int)$value;
            } elseif ($propertyType == 'boolean' || $propertyType == 'bool') {
                $value = in_array((string)$value, ['true', 'on', 'enabled']);
            } else {
                throw new \Exception("Unknown property type '{$propertyType}'.");
            }

            $this->$classProperty = $value;
        }
    }

    /**
     * Initialize list of scalar properties by response.
     *
     * @param \SimpleXMLElement $apiResponse
     * @param array             $properties
     *
     * @throws \Exception
     */
    protected function _initStructProperties($apiResponse, array $properties)
    {
        foreach ($properties as $property) {
            if (is_array($property)) {
                $classProperty = current($property);
                $value         = (isset($apiResponse[key($property)])) ? $apiResponse[key($property)] : null;
            } else {
                $classProperty = $this->_underToCamel(str_replace('-', '_', $property));
                $value         = (isset($apiResponse[$property])) ? $apiResponse[$property] : null;
            }

            $this->$classProperty = $value;
        }
    }

    /**
     * Convert underscore separated words into camel case.
     *
     * @param string $under
     *
     * @return string
     */
    private function _underToCamel($under)
    {
        $under = '_' . str_replace('_', ' ', strtolower($under));

        return ltrim(str_replace(' ', '', ucwords($under)), '_');
    }
}
