<?php
namespace Melindrea\Test\CharacterLoader;

use \Melindrea\Test\BaseTestCase as Base;
use \Melindrea\Exalted\CharacterLoader\XML as XMLLoader;

class XMLTest extends Base
{

    /**
     * Tests the XML loader (and in extension the interface).
     *
     * @return void
     */
    protected $object;

    public function setUp()
    {
        parent::setUp();

        $validPath = sprintf('%sfiles/valid.xml', $this->path);
        $this->object = new XMLLoader($validPath);
    }

    public function testValidObject()
    {
        $this->assertInstanceOf('Melindrea\Exalted\CharacterLoader\XML', $this->object);
    }

    public function testImplements()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Interfaces\Loadable', $this->object);
    }

    public function testCharacter()
    {
        $this->assertInstanceOf('Melindrea\Exalted\Character', $this->object->getCharacter());
    }

    /**
     * @expectedException Melindrea\Exalted\Exceptions\FileException
     */
    public function testNonexistingFile()
    {
        new XMLLoader('does/not/exist');
    }

    /**
     * @expectedException Melindrea\Exalted\Exceptions\RemoteFileException
     */
    public function testNonexistingRemoteFile()
    {
        new XMLLoader('http://does/not/exist');
    }

    /**
     * @expectedException Melindrea\Exalted\Exceptions\InvalidXMLException
     */
    public function testInvalidFile()
    {
        new XMLLoader(sprintf('%sfiles/invalid.xml', $this->path));
    }

    public function testCharacterConverting()
    {
        $character = $this->object->getCharacter();

        $this->assertInstanceOf('Melindrea\Exalted\Character\Attributes', $character->attributes);
        // $this->assertEquals('Solar', $character->type, 'Type is wrong');
        // $this->assertEquals('Last Wish', $character->name, 'Name is wrong');
        // $this->assertEquals('Motivation', $character->motivation, 'Motivation is wrong');
        // $this->assertEquals('Something', $character->characterization, 'Characterization is wrong');
        // $this->assertEquals('Melindrea', $character->player, 'Player is wrong');
        // $this->assertEquals(1, $character->essence, 'Essence is wrong');
        // $this->assertEquals(1, $character->willpower, 'Willpower is wrong');
        // $this->assertEquals(1, $character->compassion, 'Compassion is wrong');
        // $this->assertEquals(1, $character->conviction, 'Conviction is wrong');
        // $this->assertEquals(1, $character->temperance, 'Temperance is wrong');
        // $this->assertEquals(1, $character->valor, 'Valor is wrong');
    }
}
