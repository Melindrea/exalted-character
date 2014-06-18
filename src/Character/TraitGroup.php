<?php
namespace Melindrea\Exalted\Character;

class TraitGroup
{
    public function __construct($name, array $traits = array())
    {
        $this->name = $name;
        $this->traits = $traits;
    }
}
