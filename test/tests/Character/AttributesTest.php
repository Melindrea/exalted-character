<?php
namespace Melindrea\Test\Character;

use \Melindrea\Test\BaseTestCase as Base;
use \Melindrea\Exalted\Character\Attributes as Attributes;
use \Melindrea\Exalted\CharacterTrait as CTrait;
use \Melindrea\Exalted\Character\TraitGroup as TraitGroup;

class AttributesTest extends Base
{

    /**
     * Tests the XML loader (and in extension the interface).
     *
     * @return void
     */
    protected $object;

    public function setUp()
    {
        $traits = array();
        $attributes = array(
            'physical' => array('strength', 'dexterity', 'stamina'),
            'social' => array('charisma', 'manipulation', 'appearance'),
            'mental' => array('perception', 'intelligence', 'wits'),
        );
        foreach ($attributes as $group => $items) {
            $temp = array();

            foreach ($items as $name) {
                $temp[] = new CTrait($name, 1);
            }

            $traits[] = new TraitGroup($group, $temp);
        }
        $this->object = new Attributes($traits);
    }

    public function testValidObject()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Character\Attributes', $this->object);
    }
}
