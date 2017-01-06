<?php

namespace Mna\ActiveRecord;

use Mna\Exception\MemberFunctionException;

class Actor extends Base
{
    protected $_name;
    protected $_dob;

    /** Overriding base _jsonPropertiesMap to add support for name and dob parameters. */
    protected $_jsonPropertiesMap = [
        'name' => 'getName',
        'dob' => 'getDob',
        'guid' => 'getGuid',
    ];

    /**
     * Convenience function to access protected property _name.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @return  string the name of the actor, or null if this actor has no name.
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * Sets the name property of this object according to the given parameter $name.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   string $name the name property which will be set.
     * @return  object $this so that we can chain setters.
     */
    public function setName(string $name): object
    {
        $this->_name = $name;

        return $this;
    }

    /**
     * Convenience function to access protected property _dob.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   mixed $stringFormat the format of the returned DOB string. null will return the default format.
     * @return  string|null a string representation of the DateTime objected stored in the dob property of this object.
     */
    public function getDOB($stringFormat = 'd/n/Y'): string
    {
        if (!$this->_dob || !$this->_dob instanceof DateTime) {
            return null;
        }

        return $this->_dob->format($stringFormat);
    }

    /**
     * Sets the dob property of this object.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   mixed $dob - the dob to set as a date string, timestamp or DateTime object.
     * @return  Object $this so that we can chain setters.
     * @throws  MemberFunctionException
     */
    public function setDob($dob): object
    {
        if (!$dob) {
            throw new MemberFunctionException('Called setDob but passed no $dob param');
        }

        if (is_int($dob)) {
            $this->_dob = new DateTime('@' . $dob);
        }

        if (is_string($dob)) {
            $strDOB = strtotime($dob);

            if ($strDOB) {
                $this->_dob = new DateTime('@' . $strDOB);
            }
        }

        if ($dob instanceof DateTime) {
            $this->_dob = $dob;
        }

        return $this;
    }
}
