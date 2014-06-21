<?php
namespace Melindrea\Test\Character;

use \Melindrea\Test\BaseTestCase as Base;
use \Melindrea\Exalted\Character\Attributes as Attributes;

class AttributesTest extends Base
{

    /**
     * Tests Attributes.
     *
     * @return void
     */
    protected $object;

    public function setUp()
    {
        $traits = array();
        $this->object = new Attributes($traits);
    }

    public function testValidObject()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Character\Attributes', $this->object);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Base', $this->object);
    }

    public function testTraits()
    {
        $this->assertContainsOnlyInstancesOf('Melindrea\Exalted\Character\Traits', $this->object->traits);
    }
}
