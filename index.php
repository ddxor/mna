<?php

require_once('autoloader.php');

$actor1 = new Mna\ActiveRecord\Actor();
$actor1->setGuid(uniqid())
       ->setName('John Doe')
       ->setDob('1 June 1991');

$character11 = new Mna\ActiveRecord\Character();
$character11->setGuid(uniqid())
            ->setName('Bob Smith');

$character12 = new Mna\ActiveRecord\Character();
$character12->setGuid(uniqid())
            ->setName('Alex Road');

$actor1->addCharacter($character11)
       ->addCharacter($character12);

$actor2 = new Mna\ActiveRecord\Actor();
$actor2->setGuid(uniqid())
       ->setName('Paul Smith')
       ->setDob('5 Aug 1988');

$character21 = new Mna\ActiveRecord\Character();
$character21->setGuid(uniqid())
            ->setName('Bob Smith');

$actor2->addCharacter($character21);

$movie = new Mna\ActiveRecord\Movie();
$movie->setGuid(uniqid())
      ->setTitle('Amazing Action Film')
      ->setRuntime(5400) // 1.5 hours
      ->setReleaseDate('25 Oct 2015')
      ->addActor($actor1)
      ->addActor($actor2);

die(var_dump($movie));