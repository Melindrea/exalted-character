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
}
