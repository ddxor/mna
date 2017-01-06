<?php

namespace Mna\ActiveRecord;

/**
 * Class CharacterIterator - see notes in ActorCollection
 */
class CharacterIterator implements \Iterator
{
    private $position = 0;
    private $array = [];

    public function __construct($characters)
    {
        $this->array = $characters;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->array[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        return $this->array[++$this->position];
    }

    public function valid()
    {
        return isset($this->array[$this->position]);
    }
}