<?php
namespace Melindrea\Test\Character;

use \Melindrea\Test\BaseTestCase as Base;
use \Melindrea\Exalted\Character\Solar as Character;

class SolarTest extends Base
{

    /**
     * Tests Solar class.
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
        $this->assertInstanceOf('Melindrea\Exalted\Character\Solar', $this->object);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Character', $this->object);
    }

    public function testType()
    {
        $this->assertEquals('Solar', $this->object->type());
    }
}
