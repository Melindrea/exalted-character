<?php
namespace Melindrea\Exalted\Character;

class Traits extends \Melindrea\Exalted\Base
{
    protected $data = array();

    public function __construct($name, array $traits = array())
    {
        $values = array_merge(array('name' => $name), $traits);
        $this->values($values);
    }
}
