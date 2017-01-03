<?php

namespace Mna\ActiveRecord;

use JsonSerializable;

abstract class Base implements JsonSerializable
{
    protected $_guid;

    /**
     * Populating some sample data
     */
    public function __construct()
    {
        $this->_guid = uniqid();
    }

    protected function _getGuid() : string
    {
        return $this->_guid;
    }

    public function toJson() : string
    {
        return json_encode($this);
    }

    public function jsonSerialize() : array
    {
        $response = [];

        foreach ($this->_jsonPropertiesMap as $jsonKey => $jsonPropName) {
            $response[$jsonKey] = $this->$jsonPropName();
        }

        return $response;
    }
}
