<?php

namespace Mna\ActiveRecord;

use Mna\Seed as Seed;

/**
 * An ActiveRecord class that represents an actor
 *
 * @author James Anslow <return.404@gmail.com>
 *
 */
class Actor extends Base
{
    protected $_name;
    protected $_dob;

    protected $_jsonPropertiesMap = [
        'name'  => 'getName',
        'dob'   => 'getDob',
        'guid'  => 'getGuid',
    ];

    /**
     * Populating some sample data
     */
    public function __construct()
    {
        parent::__construct();

        $this->_name = Seed::generateString();
        $this->_dob = Seed::generateDOB();
    }

    /**
     * Convenience function to access protected property _guid from the base class
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   none
     * @return  String the GUID of this object
     *
     */
    public function getGuid() : string
    {
        return self::_getGuid();
    }

    /**
     * Convenience function to access protected property _name
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   none
     * @return  String the name of the actor, or null if this actor has no name
     *
     */
    public function getName() : string
    {
        return $this->_name;
    }

    /**
     * Convenience function to access protected property _dob
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   $stringFormat defines the format of the returned DOB string
     * @return  String
     *
     */
    public function getDOB($stringFormat='d/n/Y') : string
    {
        if (!$this->_dob) {
            return null;
        }

        return $this->_dob->format($stringFormat);
    }

    /**
     * Sets the name property of this object
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   $name the name to set
     * @return  Object $this so that we can chain setters
     *
     */
    public function setName(String $name) : object
    {
        if (!$name) {
            return $this;
        }

        if (!is_string($name)) {
            return $this;
        }

        $this->_name = $name;

        return $this;
    }

    /**
     * Sets the dob property of this object
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   $dob the dob to set as a date string, timestamp or DateTime object
     * @return  Object $this so that we can chain setters
     *
     */
    public function setDob($dob) : object
    {
        if (!$dob) {
            return $this;
        }

        if (is_int($dob)) {
            $this->_dob = new DateTime('@' . $dob);
        }

        if (is_string($dob)) {
            $this->_dob = new DateTime('@' . strtotime($dob));
        }

        if ($dob instanceof DateTime) {
            $this->_dob = $dob;
        }

        return $this;
    }
}
