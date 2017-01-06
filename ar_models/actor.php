<?php

namespace Mna\ActiveRecord;

use Mna\Exception\MemberFunctionException;
use \DateTime;

class Actor extends Base
{
    protected $_name;
    protected $_dob;
    protected $_characterCollection;

    /** Overriding base _jsonPropertiesMap to add support for name and dob parameters. */
    protected $_jsonPropertiesMap = [
        'name' => 'getName',
        'dob' => 'getDob',
        'guid' => 'getGuid',
    ];

    public function __construct()
    {
        $this->_characterCollection = new CharacterCollection();
    }

    /**
     * Convenience function to add an actor association to this movie
     *
     * @author James Anslow <return.404@gmail.com>
     * @param Character $character - the character to associate with this actor
     * @return object $this - for chaining purposes
     */
    public function addCharacter(Character $character)
    {
        $this->_characterCollection->addItem($character);

        return $this;
    }

    /**
     * A simple convenience function that calls getAll on the character collection object
     *
     * @author James Anslow <return.404@gmail.com>
     * @return object a collection of the characters associated with this actor
     */
    public function getCharacters()
    {
        return $this->_characterCollection->getAll();
    }

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
     * Sets the _name property of this object according to the given parameter $name.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   string $name the name property which will be set.
     * @return  Actor $this so that we can chain setters.
     */
    public function setName(string $name): Actor
    {
        $this->_name = $name;

        return $this;
    }

    /**
     * Convenience function to access protected property _dob.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   mixed $stringFormat the format of the returned DOB string. null will return the default format.
     * @return  string a string representation of the DateTime objected stored in the dob property of this object.
     */
    public function getDOB($stringFormat = 'd/n/Y'): string
    {
        $dob = '';

        if ($this->_dob && $this->_dob instanceof DateTime) {
            $dob = $this->_dob->format($stringFormat);
        }

        return $dob;
    }

    /**
     * Sets the _dob property of this object.
     *
     * @author  James Anslow <return.404@gmail.com>
     * @param   mixed $dob - the dob to set as a date string, timestamp or DateTime object.
     * @return  Actor $this so that we can chain setters.
     * @throws  MemberFunctionException
     */
    public function setDob($dob): Actor
    {
        if (!$dob) {
            throw new MemberFunctionException('Called setDob but passed no $dob param');
        }

        if (is_int($dob)) {
            $this->_dob = new \DateTime('@' . $dob);
        }

        if (is_string($dob)) {
            $strDOB = strtotime($dob);

            if (!$strDOB) {
                throw new MemberFunctionException('Could not convert given dob to time');
            }

            $this->_dob = new \DateTime('@' . $strDOB);
        }

        if ($dob instanceof DateTime) {
            $this->_dob = $dob;
        }

        return $this;
    }
}
