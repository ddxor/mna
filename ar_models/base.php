<?php

namespace Mna\ActiveRecord;

use JsonSerializable;

abstract class Base implements JsonSerializable
{
    protected $_guid;
    protected $_jsonPropertiesMap = [
        'guid' => 'getGuid',
    ];

    /**
     * Convenience function to universally return a representation of this object (or rather more commonly the object
     * that extends this base class) to a JSON string.
     *
     * @author James Anslow <return.404@gmail.com>
     * @return string the json string representing the child object that this method was called on
     */
    public function toJson(): string
    {
        return json_encode($this);
    }

    /**
     * Create a representation of this object as per JsonSerializable interface requirement.
     *
     * @author James Anslow <return.404@gmail.com>
     * @return array
     */
    public function jsonSerialize(): array
    {
        $response = [];

        foreach ($this->_jsonPropertiesMap as $jsonKey => $jsonPropName) {
            $response[$jsonKey] = $this->$jsonPropName();
        }

        return $response;
    }

    /**
     * Convenience function to access protected property _guid.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @return  string the GUID of this object
     */
    public function getGuid(): string
    {
        return $this->_guid;
    }

    /**
     * A convenience function to set a guid for this object.
     *
     * @author James Anslow <return.404@gmail.com>
     * @param string $guid the guid to set
     * @return Object - this class. For the purposes of chaining setters.
     */
    public function setGuid(string $guid)
    {
        $this->_guid = $guid;

        return $this;
    }
}
