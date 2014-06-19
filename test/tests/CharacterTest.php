<?php
namespace Melindrea\Test;

use \Melindrea\Test\BaseTestCase as Base;
use \Melindrea\Exalted\Character as Character;

class CharacterTest extends Base
{

    /**
     * Tests Character class.
     *
     * @return void
     */
    protected $object;

    public function setUp()
    {
        parent::setUp();

        $this->object = new Character();
    }

    public function testValidObject()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Character', $this->object);
    }

    public function testType()
    {
        $this->assertNull($this->object->type());
    }
}
