<?php
namespace Melindrea\Test;

use \Melindrea\Test\BaseTestCase as Base;
use \Melindrea\Exalted\CharacterLoader\XML as XMLLoader;
use \Melindrea\Exalted\CharacterLoader as Loader;

class CharacterLoaderTest extends Base
{

    /**
     * Tests the static loader.
     *
     * @return void
     */
    public function testLoad()
    {
        $validPath = sprintf('%sfiles/valid.xml', $this->path);
        $this->assertInstanceOf('Melindrea\Exalted\Character', Loader::load(new XMLLoader($validPath)));
    }
}
