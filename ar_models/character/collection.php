<?php

namespace Mna\ActiveRecord;

use Mna\Exception\CollectionException;

/**
 * Class CharacterCollection - see notes in ActorCollection
 */
class CharacterCollection implements CollectionInterface
{
    protected $_characters = [];

    public function getAll()
    {
        return (new CharacterIterator($this->_characters));
    }

    public function addItem($character)
    {
        if (!$character instanceof Character) {
            throw new CollectionException('Parameter passed to addItem not an instance of Character');
        }

        $this->_characters[$character->getGuid()] = $character;

        return $this;
    }

    public function getItem(string $guid)
    {
        if (!array_key_exists($guid, $this->_characters)) {
            throw new CollectionException('Called getItem with a $guid that isn\'t in the collection');
        }

        return $this->_characters[$guid];
    }

    public function deleteItem(string $guid)
    {
        if (!array_key_exists($guid, $this->_characters)) {
            throw new CollectionException('Called getItem with a $guid that isn\'t in the collection');
        }

        unset($this->_characters[$guid]);
    }
}
