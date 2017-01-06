<?php

namespace Mna\ActiveRecord;

class Character extends Base
{
    protected $_name;

    /** Overriding base _jsonPropertiesMap to add support for the name parameter. */
    protected $_jsonPropertiesMap = [
        'name' => 'getName',
    ];

    /**
     * Convenience function to access protected property _name.
     *
     * @author James Anslow <return.404@gmail.com>
     * @return string the name of this character, or null if this character has no name.
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
     * @return  Character $this so that we can chain setters.
     */
    public function setName(string $name): Character
    {
        $this->_name = $name;

        return $this;
    }
}
