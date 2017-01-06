<?php

namespace Mna\ActiveRecord;

interface CollectionInterface
{
    public function getAll();

    public function getItem(string $guid);

    public function addItem($item);

    public function deleteItem(string $guid);
}
