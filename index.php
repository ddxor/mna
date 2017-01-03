<?php

require_once('seed.php');
require_once('ar_models/base.php');
require_once('ar_models/actor.php');
require_once('ar_models/character.php');
require_once('ar_models/movie.php');

$actor = new Mna\ActiveRecord\Actor();

echo $actor->toJson();
