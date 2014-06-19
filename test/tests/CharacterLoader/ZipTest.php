<?php
namespace Melindrea\Test\CharacterLoader;

use \Melindrea\Test\BaseTestCase as Base;
use \Melindrea\Exalted\CharacterLoader\Zip as ZipLoader;

class ZipTest extends Base
{

    /**
     * Tests the Zip loader (and in extension the interface).
     *
     * @return void
     */
    protected $object;

    public function setUp()
    {
        parent::setUp();

        $validPath = sprintf('%sfiles/valid.zip', $this->path);
        $this->object = new ZipLoader($validPath);
    }

    public function testValidObject()
    {
        $this->assertInstanceOf('Melindrea\Exalted\CharacterLoader\Zip', $this->object);
    }

    public function testInheritance()
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
        new ZipLoader('does/not/exist');
    }

    /**
     * @expectedException Melindrea\Exalted\Exceptions\ZipFileException
     */
    public function testNonZipFile()
    {
        new ZipLoader(sprintf('%sfiles/valid.xml', $this->path));
    }

    /**
     * @expectedException Melindrea\Exalted\Exceptions\ZipFileException
     */
    public function testInvalidFile()
    {
        new ZipLoader(sprintf('%sfiles/empty.zip', $this->path));
    }

    /**
     * @expectedException Melindrea\Exalted\Exceptions\InvalidXMLException
     */
    public function testInvalidXMLFile()
    {
        new ZipLoader(sprintf('%sfiles/invalid.zip', $this->path));
    }
}
