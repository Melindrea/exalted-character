<?php
namespace Melindrea\Test;

use \Melindrea\Test\BaseTestCase as Base;
use \Melindrea\Exalted\CharacterTrait as CTrait;

class CharacterTraitTest extends Base
{

    /**
     * Tests CharacterTrait class.
     *
     * @return void
     */
    protected $object;

    public function setUp()
    {
        parent::setUp();

        $this->object = new CTrait('Strength', 2);
    }

    public function testValidObject()
    {
        $this->assertInstanceOf('Melindrea\Exalted\CharacterTrait', $this->object);
    }

    public function testInheritance()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Base', $this->object);
    }
}
