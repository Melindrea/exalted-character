<?php
namespace Melindrea\Test;

class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    protected $path;
    /**
     * Base test.
     *
     * @return void
     */

    protected function setUp()
    {
        parent::setUp();
        $this->path = sprintf('%s/../', dirname(__FILE__));
    }

    protected function tearDown()
    {
        \Mockery::close();
        parent::tearDown();
    }
}
