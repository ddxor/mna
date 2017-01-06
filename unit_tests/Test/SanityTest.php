<?php

namespace Mna\Test;

require_once('autoloader.php');

class SanityTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGetSetActor()
    {
        $actor = new \Mna\ActiveRecord\Actor();

        $this->assertNotEmpty($actor);
        $this->assertEquals('Mna\ActiveRecord\Actor', get_class($actor));

        $guid = uniqid();
        $actor->setGuid($guid);
        $this->assertEquals($guid, $actor->getGuid());

        $name = 'John Doe';
        $actor->setName($name);
        $this->assertEquals($name, $actor->getName());

        $dobStr = '1 Jun 1980';
        $actor->setDob($dobStr);
        $this->assertEquals('1/Jun/1980', $actor->getDob('j/M/Y'));
    }
}
