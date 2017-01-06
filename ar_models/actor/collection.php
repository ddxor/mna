<?php

namespace Mna\ActiveRecord;

use Mna\Exception\CollectionException;

/**
 * Class ActorCollection - a collection object to store instances of Actor. getAll returns an ActorIterator that
 * implements a standard iterator. I have intentionally kept the collection and iterator separate so that we can
 * support adding and removing items without risking a collision in the iterator.
 *
 * I have chosen to have specific collections for each model (rather than a generic collection class) so that I can
 * carry out type checking and type hinting as seen below.
 *
 * A use case might be:
 *
 *      foreach ($movie->getActors() as $actor) {
 *          .....
 *      }
 *
 * @author James Anslow <return.404@gmail.com>
 */
class ActorCollection implements CollectionInterface
{
    protected $_actors = [];

    public function getAll()
    {
        return (new ActorIterator($this->_actors));
    }

    public function addItem($actor)
    {
        if (!$actor instanceof Actor) {
            throw new CollectionException('Parameter passed to addItem not an instance of Actor');
        }

        $this->_actors[$actor->getGuid()] = $actor;

        return $this;
    }

    public function getItem(string $guid)
    {
        if (!array_key_exists($guid, $this->_actors)) {
            throw new CollectionException('Called getItem with a $guid that isn\'t in the collection');
        }

        return $this->_actors[$guid];
    }

    public function deleteItem(string $guid)
    {
        if (!array_key_exists($guid, $this->_actors)) {
            throw new CollectionException('Called getItem with a $guid that isn\'t in the collection');
        }

        unset($this->_actors[$guid]);
    }
}
