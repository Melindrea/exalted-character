<?php
namespace Melindrea\Exalted;

class CharacterTrait
{
    public function __construct($name, $value, $favored = false, array $specialties = array())
    {
        $this->name = $name;
        $this->value = $value;
        $this->favored = $favored;
        $this->specialties = $specialties;
    }
}
