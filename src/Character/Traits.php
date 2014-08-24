<?php
namespace Melindrea\Exalted\Character;

class Traits extends \Melindrea\Exalted\Base
{
    public function __construct($name, array $traits = [])
    {
        $values = array_merge(['name' => $name], $traits);
        $this->values($values);
    }
}
