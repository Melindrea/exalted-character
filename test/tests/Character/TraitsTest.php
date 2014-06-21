<?php
namespace Melindrea\Test\Character;

use \Melindrea\Test\BaseTestCase as Base;
use \Melindrea\Exalted\Character\Traits as Traits;

class TraitsTest extends Base
{

    /**
     * Tests Traits.
     *
     * @return void
     */
    protected $object;

    public function setUp()
    {
        $this->object = new Traits('Physical');
    }

    public function testValidObject()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Character\Traits', $this->object);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Base', $this->object);
    }
}
